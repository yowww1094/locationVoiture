<?php

class Locations extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $location = new Location();
        $data = array();
        $searchResults = array();
        $errors = array();

        $limit = 8;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "select * from locations limit $limit offset $offset";

        if(count($_POST) > 0){
            if($location->searchValidate($_POST)){

                $matricule = (empty($_POST['matricule'])) ? "" : "%".$_POST['matricule']."%";
                $marque = (empty($_POST['marque'])) ? "" : "%".$_POST['marque']."%";
                $model = (empty($_POST['model'])) ? "" : "%".$_POST['model']."%";
                $nom = (empty($_POST['nom'])) ? "" : "%".$_POST['nom']."%";
                $prenom = (empty($_POST['prenom'])) ? "" : "%".$_POST['prenom']."%";
                $cin = (empty($_POST['cin'])) ? "" : "%".$_POST['cin']."%";
                $date_depart = (empty($_POST['date_depart'])) ? "" : $_POST['date_depart'];
                $date_retour = (empty($_POST['date_retour'])) ? "" : $_POST['date_retour'];
                $prixMin = (empty($_POST['prixMin'])) ? "" : $_POST['prixMin'];
                $prixMax = (empty($_POST['prixMax'])) ? "" : $_POST['prixMax'];


                $searchQuery = "SELECT * FROM locations 
                                    JOIN clients ON locations.id_client=clients.id_client 
                                    JOIN voitures ON voitures.matricule=locations.matricule
                                    WHERE voitures.matricule LIKE '$matricule' OR marque LIKE '$marque' OR model LIKE '$model'
                                            OR nom LIKE '$nom' OR prenom LIKE '$prenom' OR cin LIKE '$cin'
                                            OR date_depart >= '$date_depart' AND date_retour <= '$date_retour' OR
                                            prix BETWEEN '$prixMin' AND '$prixMax' limit $limit offset $offset";
                                            show($searchQuery);

                $searchResults = $location->query($searchQuery);
            }else{

                $errors = $location->errors;
                $data = $location->query($query);
            }
            
        }else{

            $data = $location->query($query);
        }

       

        $this->view('locations', [
            'rows' => $data,
            "searchResults" => $searchResults,
            "pager" => $pager,
            "errors" => $errors,
        ]);
    }

    public function details($locationId = '')
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if($locationId == '') {
            
            $this->redirect('locations');
        }

        $location = new Location();

        $res = $location->where('id_location', $locationId);

        if ($res) {
            $data = $res[0];
        }

        $this->view('locations.details', 
        [
            'row' => $data,
        ]);
    }

    public function add($carId = '')
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if ($carId == '') {
            
            $this->redirect('voitures');
        }

        $info = array();
        $errors = array();

        $location = new Location();
        # check car state
        $query = 'select * from locations where matricule=:matricule && state = 1';
        $carState = $location->query($query, ['matricule'=>$carId]);

        if($carState){

            $info = $carState;
           
        }

        $client  = new Client();
        $voiture = new Voiture();
        $data = $voiture->where("matricule", $carId);

        $data = $data[0];

        $errors = array();

        if (isset($carId)) {
            
            if(count($_POST) > 0){

                $_POST['matricule'] = $carId;
               
                #extracting images
                if(count($_FILES) > 0){

                    $error = array();

                    foreach($_FILES as $key => $file){
                        
                        $_POST[$key] = upload_image($file);
                        array_push($errors, $error);
                    }
                }

                if(!$client->validate($_POST) && !$location->validate($_POST)){

                    array_push($errors, $client->errors);
                    array_push($errors, $location->errors);
                }else{

                    $locationErrorCount = 0;
                    
                    if($carState){

                        foreach($carState as $car){
                            if($car->date_retour > $_POST['date_depart']){
                                $locationErrorCount += 1;
                            }
                        }
                    }

                    if($locationErrorCount > 0){

                        $locationError['locationError'] = 'Vous ne pouvez pas commencer location à partir de la date fournie';
                        array_push($errors, $locationError);
                    }else{
                        
                        $query = "select * from clients where cin = :cin";

                        $arr['cin'] = $_POST['cin'];
                        
                        $check_client = $client->query($query, $arr);

                        if($check_client){

                            // if client existe get his id
                            $_POST['id_client'] = $check_client[0]->id_client;
                            
                        }else{

                            // if not existe insert new client and get client id
                            $_POST['date_added'] = date("Y-m-d");
                            
                            $client->insert($_POST);

                            $get_id_client = $client->query($query, $arr);
                            $_POST['id_client'] = $get_id_client[0]->id_client;
                            
                        }

                        $_POST['date_location'] = date("Y-m-d");
                        $_POST['duree_location'] = date_duration($_POST['date_depart'], $_POST['date_retour']);

                        $location->insert($_POST);

                        # change car state from 1 to 0
                        $voiture->update('matricule',$carId, ['state'=>'0']);

                        // get location id and set notifications
                        $query_location = 'select * from locations where id_client=:id_client && matricule=:matricule';

                        $location_arr['id_client'] = $_POST['id_client'] ;
                        $location_arr['matricule'] = $_POST['matricule'] ;
                        
                        $location_id = $location->query($query_location, $location_arr);

                        if($location_id){
                            $_POST['id_location'] = $location_id[0]->id_location;
                        }

                        (new Location_notification())->set_location_notif($_POST);
                        $id_location = $_POST['id_location'];

                        $this->redirect("locations/details/$id_location");
                    }
                }
            }
        }else{
            $this->redirect("voitures");
        }

        $this->view('locations.add', [
            "voiture" => $data,
            "info" => $info,
            "errors" => $errors,
        ]);
    }

    public function edit($locationId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if ($locationId == '') {
            
            $this->redirect('voitures');
        }

        $location = new Location();
        $errors = array();
    
        if(count($_POST) > 0){

            if($location->validate($_POST)){

                $_POST['date_location'] = date("Y-m-d H:i:s");
                $_POST['duree_location'] = date_duration($_POST['date_depart'], $_POST['date_retour']);

                $location->update('id_location',$locationId, $_POST);

                // back to previous page
                $this->redirect("locations/$locationId");
            }else{

                $errors = $location->errors;
            }
        }
        
        $this->view('location.edit', [
            "errors" => $errors,
        ]);
    }

    public function finLocation($locationId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if ($locationId == '') {
            
            $this->redirect('voitures');
        }

        $location = new Location();
        $kilometer = new Kilometer();
        $voiture = new Voiture();

        $errors = array();

        $res = $location->where('id_location', $locationId);
        $matricule = $res[0]->voiture->matricule;

        if(count($_POST) > 0){
            if($kilometer->validate($_POST)){

                $_POST['date_added'] = date("Y-m-d");
                $_POST['matricule'] = $matricule;

                $kilometer->insert($_POST);

                $location->update('id_location', $locationId, ['state' => 0]);
                $voiture->update('matricule', $matricule, ['state' => 1]);

                // back to previous page
                $this->redirect("locations");
            }else{

                $errors = $kilometer->errors;
            }
        }

        $this->view('locations.finLocation', [
            'row' => $res[0],
            'errors' => $errors,
        ]);
    }
}