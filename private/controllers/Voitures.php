<?php

class Voitures extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $voiture = new Voiture();

        $data = $voiture->findAll();

        $this->view('voitures', 
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

        if(count($_POST) > 0){

            $voiture = new Voiture();

            # check if matricule already existe

            #extracting image
            if(count($_FILES)){
                
                $_POST['image_voiture'] = extract_image($_FILES['image_voiture']);
            }

            if($voiture->validate($_POST)){

                $_POST['date_added'] = date("Y-m-d");

                print_r($_POST);

                $voiture->insert($_POST);

            }else{
                $errors = $voiture->errors;
            }
        }

        $this->view('voitures.add', [
            "errors" => $errors,
        ]);
    }

    public function edit($carId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();
        if(isset($carId)){

            if(count($_POST) > 0){

                $voiture = new Voiture();
    
                #extracting image
                if(count($_FILES)){
                    
                    $_POST['image_voiture'] = extract_image($_FILES['image_voiture']);
                }
    
                if($voiture->validate($_POST)){
    
                    $_POST['date_added'] = date("Y-m-d");
    
                    $voiture->update($carId, $_POST);
    
                    $this->redirect("voitures");
                }else{
                    $errors = $voiture->errors;
                }
            }
        }

        $this->view('voitures.edit', [
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