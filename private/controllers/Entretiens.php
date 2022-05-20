<?php

class Entretiens extends controller
{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $entretien = new Entretien();
        $voiture = new Voiture();
        $data = array();
        $searchResults = array();
        $errors = array();

        if(count($_POST) > 0){
            if($entretien->searchValidate($_POST)){

                $matricule = (empty($_POST['matricule'])) ? "" : "%".$_POST['matricule']."%";
                $marque = (empty($_POST['marque'])) ? "" : "%".$_POST['marque']."%";
                $model = (empty($_POST['model'])) ? "" : "%".$_POST['model']."%";
                $type_entretien = (empty($_POST['type_entretien'])) ? "" : "%".$_POST['type_entretien']."%";
                $dateMin = (empty($_POST['dateMin'])) ? "" : $_POST['dateMin'];
                $dateMax = (empty($_POST['dateMax'])) ? "" : $_POST['dateMax'];
                $prixMin = (empty($_POST['prixMin'])) ? "" : $_POST['prixMin'];
                $prixMax = (empty($_POST['prixMax'])) ? "" : $_POST['prixMax'];

                $searchQuery = "SELECT * FROM `entretiens` JOIN `voitures` ON entretiens.matricule = voitures.matricule
                                    WHERE entretiens.matricule LIKE '$matricule' OR marque LIKE '$marque' OR model LIKE '$model'
                                        OR type_entretien LIKE '$type_entretien' OR date_entretien >= '$dateMin' AND date_entretien <= '$dateMax'
                                        OR prix_entretien BETWEEN '$prixMin' AND '$prixMax'";
                                        show($searchQuery);                                        
                $searchResults = $voiture->query($searchQuery);
            }else{

                $errors = $entretien->errors;
                $data = $entretien->query("SELECT * FROM `entretiens` JOIN `voitures` ON entretiens.matricule = voitures.matricule;");
            }
            
        }else{

            $data = $entretien->query("SELECT * FROM `entretiens` JOIN `voitures` ON entretiens.matricule = voitures.matricule;");
        }

       

        $this->view('entretiens', [
            'rows' => $data,
            "searchResults" => $searchResults,
            "errors" => $errors,
        ]);
    }

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
            $_POST['matricule'] = $carId;

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