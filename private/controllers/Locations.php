<?php

class Locations extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $location = new Location();

        $data = $location->findAll();

        $this->view('locations', 
        [
            'rows' => $data,
        ]);
    }

    public function details($locationId = '')
    {

        $data['id_location'] = $locationId;

        $this->view('locations.details', 
        [
            'rows' => $data,
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

        $voiture = new Voiture();
        # check car state
        $query = 'select * from voitures where matricule=:matricule && state=0';
        $carState = $voiture->query($query, ['matricule'=>$carId]);

        if($carState){

            $this->redirect('voitures');
        }

        $data = $voiture->where("matricule", $carId);

        $data = $data[0];

        $errors = array();

        if (isset($carId)) {
            
            if(count($_POST) > 0){

                $_POST['matricule'] = $carId;
               
                #extracting images
                if(count($_FILES) > 0){

                    $_POST['cin_img'] = extract_image($_FILES['cin_img']);
                    $_POST['permis_img'] = extract_image($_FILES['permis_img']);
                }

                # check if user already existe
                $client  = new Client();
                $query = "select * from clients where nom = :nom && prenom = :prenom && cin = :cin";

                $arr['nom'] = $_POST['nom'];
                $arr['prenom'] = $_POST['prenom'];
                $arr['cin'] = $_POST['cin'];
                

                $check_client = $client->query($query, $arr);

                if($check_client){

                    // if client existe get his id
                    $_POST['id_client'] = $check_client[0]->id_client;
                }else{
                                
                    $_POST['date_added'] = date("Y-m-d");

                    if($client->validate($_POST)){

                        // if not existe inset new client and get hin id
                        $client->insert($_POST);

                        $get_id_client = $client->query($query, $arr);
                        $_POST['id_client'] = $get_id_client[0]->id_client;
                    }else{
                        $errors = $client->errors;
                    }
                }

                $location = new Location();
                if($location->validate($_POST)){

                    $_POST['date_location'] = date("Y-m-d H:i:s");
                    $_POST['duree_location'] = date_duration($_POST['date_depart'], $_POST['date_retour']);
                    

                    # change car state from 0 to 1
                    $location->insert($_POST);

                    $voiture->update('matricule',$carId, ['state'=>'0']);
                    

                    $this->redirect("locations");
                }else{
                    $errors = $location->errors;
                }
                
                
                
            }
        }else{
            $this->redirect("voitures");
        }

        $this->view('locations.add', [
            "voiture" => $data,
            "errors" => $errors,
        ]);
    }

    public function edit($locationId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();

        if (isset($locationId)) {
            
            if(count($_POST) > 0){

                $location = new Location();

                if($location->validate($_POST)){

                    $_POST['date_location'] = date("Y-m-d H:i:s");
                    $_POST['duree_location'] = date_duration($_POST['date_depart'], $_POST['date_retour']);

                    $location->update('id_location',$locationId, $_POST);

                    // back to previous page
                    $this->redirect("locations");
                }else{
                    $errors = $location->errors;
                }
            }
        }else{
            $this->redirect("locations");
        }

        $this->view('location.edit', [
            "errors" => $errors,
        ]);
    }

    public function delete($locationId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();

        if(isset($locationId)){

        $location = new Location();
    
        $location->delete($locationId);
        $this->redirect("locations");
        }else{

            $this->redirect("locations");
        }

        $this->view('locations.delete', [
            "errors" => $errors,
        ]);
    }
}