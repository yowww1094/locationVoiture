<?php

class Assurances extends controller
{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $assurances = new Assurance();
        $data = array();
        $searchResults = array();
        $errors = array();

        if(count($_POST) > 0){
            if($assurances->searchValidate($_POST)){

                $matricule = (empty($_POST['matricule'])) ? "" : "%".$_POST['matricule']."%";
                $marque = (empty($_POST['marque'])) ? "" : "%".$_POST['marque']."%";
                $model = (empty($_POST['model'])) ? "" : "%".$_POST['model']."%";
                $numero = (empty($_POST['numero'])) ? "" : "%".$_POST['numero']."%";
                $agence = (empty($_POST['agence'])) ? "" : "%".$_POST['agence']."%";
                $date_debut = (empty($_POST['date_debut'])) ? "" : $_POST['date_debut'];
                $date_fin = (empty($_POST['date_fin'])) ? "" : $_POST['date_fin'];
                $prixMin = (empty($_POST['prixMin'])) ? "" : $_POST['prixMin'];
                $prixMax = (empty($_POST['prixMax'])) ? "" : $_POST['prixMax'];

                $searchQuery = "SELECT * FROM assurances JOIN voitures ON assurances.matricule = voitures.matricule
                                    WHERE assurances.matricule LIKE '$matricule' OR marque LIKE '$marque' OR model LIKE '$model'
                                        OR numero LIKE '$numero' OR agence LIKE '$agence' OR date_debut LIKE '$date_debut' OR date_fin LIKE '$date_fin'
                                        OR prix BETWEEN '$prixMin' AND '$prixMax'";     

                $searchResults = $assurances->query($searchQuery);
            }else{

                $errors = $assurances->errors;
                $data = $assurances->query("SELECT * FROM `assurances` JOIN `voitures` ON assurances.matricule = voitures.matricule ORDER BY assurances.date_added DESC;");
            }
            
        }else{

            $data = $assurances->query("SELECT * FROM `assurances` JOIN `voitures` ON assurances.matricule = voitures.matricule ORDER BY assurances.date_added DESC");
        }

       

        $this->view('assurances', [
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

            $assurances = new Assurance();
            $_POST['matricule'] = $carId;
            $_POST['date_added'] = date('Y-m-d');

            if($assurances->validate($_POST)){

                $assurances->insert($_POST);
            }else{

                $errors = $assurances->errors;
            }
        }
        

        $this->view('assurances.add', [
            "rows" => $data,
            "errors" => $errors,
        ]);
    }

    public function edit($assuranceId)
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $errors = array();

        if(isset($assuranceId)){

            if(count($_POST) > 0){

                $assurance = new Assurance();

                if($assurance->validate($_POST)){

                    $assurance->update('id_assurance', $assuranceId, $_POST);

                    $this->redirect("voitures");
                }else{

                    $errors = $assurance->errors;
                }
            }
        }else{
            
            $this->redirect("entretiens");
        }

        $this->view('assurances.edit', [
            "errors" => $errors,
        ]);
    }
}