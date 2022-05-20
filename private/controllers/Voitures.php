<?php

class Voitures extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $voiture = new Voiture();
        $data = array();
        $searchResults = array();
        $errors = array();

        if(count($_POST) > 0){
            if($voiture->searchValidate($_POST)){

                $matricule = (empty($_POST['matricule'])) ? "" : "%".$_POST['matricule']."%";
                $marque = (empty($_POST['marque'])) ? "" : "%".$_POST['marque']."%";
                $model = (empty($_POST['model'])) ? "" : "%".$_POST['model']."%";
                $date_assurance_depuis = (empty($_POST['date_assurance_depuis'])) ? "" : $_POST['date_assurance_depuis'];
                $date_assurance_jusqua = (empty($_POST['date_assurance_jusqua'])) ? "" : $_POST['date_assurance_jusqua'];
                $date_viniete_depuis = (empty($_POST['date_viniete_depuis'])) ? "" : $_POST['date_viniete_depuis'];
                $date_viniete_jusqua = (empty($_POST['date_viniete_jusqua'])) ? "" : $_POST['date_viniete_jusqua'];
                $state = (empty($_POST['state'])) ? "" : ($_POST['state'] == ('disponible') ? '1' : '0') ;

                $stateCol = 'state';


                $searchQuery = "SELECT * FROM voitures 
                                    WHERE matricule LIKE '$matricule' OR marque LIKE '$marque' OR model LIKE '$model'
                                           OR date_assurance BETWEEN '$date_assurance_depuis' AND '$date_assurance_jusqua'
                                           OR date_viniete BETWEEN '$date_viniete_depuis' AND '$date_viniete_jusqua'
                                           OR $stateCol LIKE '$state'";
                                           

                $searchResults = $voiture->query($searchQuery);
            }else{

                $errors = $voiture->errors;
                $data = $voiture->orderBy('state', 'DESC');
            }
            
        }else{

            $data = $voiture->orderBy('state');
        }

       

        $this->view('voitures', [
            'rows' => $data,
            "searchResults" => $searchResults,
            "errors" => $errors,
        ]);
    }

    public function details($carId = '')
    {

        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if($carId == ''){

            $this->redirect('voitures');
        }

        $voiture = new Voiture();
        $car = $voiture->where('matricule', $carId);

        if($car){
            $data = $car[0];
        }

        $this->view('voitures.details', 
        [
            'rows' => $data,
        ]);
    }

    public function add()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();
        $voiture = new Voiture();

        

        if(count($_POST) > 0){

            # check if matricule already existe
            $matricule  = $_POST['matricule'];
            if($voiture->where("matricule", $matricule)){

                $errors['car_existe'] = "La voiture déjà existe, essayez de changer matricule !";
            }else{

                #extracting image
                if(count($_FILES)){
                    
                    $_POST['image_voiture'] = extract_image($_FILES['image_voiture']);
                }

                if($voiture->validate($_POST)){

                    $_POST['date_added'] = date("Y-m-d");

                    $voiture->insert($_POST);

                }else{
                    $errors = $voiture->errors;
                }
            }

            // get car id and set notifications
            $car_id = $voiture->where("matricule", $matricule);
            if($car_id){
                $car_id = $car_id[0]->matricule;
            }

            (new Voiture_notification())->set_voiture_notif($car_id, $_POST);

        }

        $this->view('voitures.add', [
            "errors" => $errors,
        ]);
    }

    public function edit($carId = '')
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();
        if($carId == ''){

            $this->redirect('voitures');
        }

        $voiture = new Voiture();
        $car = $voiture->where('matricule', $carId);

        if($car){

            $data = $car[0];
        }

        if(count($_POST) > 0){

            #extracting image
            if(count($_FILES)){
                
                $_POST['image_voiture'] = extract_image($_FILES['image_voiture']);
            }

            if($voiture->validate($_POST)){

                $_POST['date_added'] = date("Y-m-d");

                $voiture->update('matricule', $carId, $_POST);
                
                // update notifications
                (new Voiture_notification())->update_voiture_notif($carId, $_POST);

                $this->redirect("voitures");

            }else{
                $errors = $voiture->errors;
            }

        }

        $this->view('voitures.edit', [
            "rows" => $data,
            "errors" => $errors,
        ]);
    }

    public function delete($carId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if(isset($carId)){

            $voiture = new Voiture();
        
            $voiture->delete($carId);
            $this->redirect("voitures");
        }else{

            $this->redirect("voitures");
        }

        $this->view('voitures.delete');
    }
}