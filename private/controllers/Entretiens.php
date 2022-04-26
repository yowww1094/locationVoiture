<?php

class Entretiens extends controller{

    public function add($carId = '')
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

            $entretien = new Entretien();

            if($entretien->validate($_POST)){

                $entretien->insert($_POST);

            }else{

                $errors = $entretien->errors;
            }
        }
        

        $this->view('entretiens.add', [
            "rows" => $data,
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

                    //$entretien->update($entretienId, $_POST);

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