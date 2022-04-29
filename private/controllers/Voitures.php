<?php

class Voitures extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $voiture = new Voiture();

        $available = $voiture->where('state', 1);
        $unavailable = $voiture->where('state', 0);

        $data['available'] = $available;
        $data['unavailable'] = $unavailable;

        $this->view('voitures', 
        [
            'rows' => $data,
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

                $errors['car_existe'] = "La voiture existe déjà, essayez de changer matricule !";
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

                //$voiture->update($carId, $_POST);

                $this->redirect("voitures");
            }else{
                $errors = $voiture->errors;
            }

            // set notifications

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