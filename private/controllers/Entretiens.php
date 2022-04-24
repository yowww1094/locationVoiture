<?php

class Entretiens extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $entretien = new Entretien();

        $data = $entretien->findAll();

        $this->view('entretiens', 
        [
            'data' => $data,
        ]);
    }

    public function add($carId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();

        if(isset($carId)){

            if(count($_POST) > 0){

                $entretien = new Entretien();

                if($entretien->validate($_POST)){

                    $entretien->insert($_POST);

                    $this->redirect("entretiens");
                }else{

                    $errors = $entretien->errors;
                }
            }
        }else{

            $this->redirect("voitures");
        }

        $this->view('entretien.add', [
            "errors" => $errors,
        ]);
    }

    public function edit($entretienId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();

        if(isset($entretienId)){

            if(count($_POST) > 0){

                $entretien = new Entretien();

                if($entretien->validate($_POST)){

                    $entretien->update($entretienId, $_POST);

                    $this->redirect("entretiens");
                }else{

                    $errors = $entretien->errors;
                }
            }
        }else{
            
            $this->redirect("entretiens");
        }

        $this->view('entretien.edit', [
            "errors" => $errors,
        ]);
    }
}