<?php

class Locations extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $location = new Location();

        $data = $location->findAll();

        $this->view('location', 
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

        if (isset($carId)) {
            
            if(count($_POST) > 0){

                $location = new Location();
                $client  = new Client();

                #extracting images
                if(count($_FILES) > 0){

                    $_POST['cin_img'] = extract_image($_FILES['cin_img']);
                    $_POST['permis_img'] = extract_image($_FILES['permis_img']);
                }

                # check if user already existe
                $query = "select * from clients where nom = :nom && prenom = :prenom && cin_img = :cin_img && permis_img = :permis_img && client_phone = :client_phone";
                $check_client = $client->query($query, $_POST);

                if(!$check_client){

                    if($client->validate($_POST)){

                        $_POST['date_added'] = date("Y-m-d");
                        $client->insert($_POST);

                        $get_id_client = $client->query($query, $_POST);
                        $_POST['id_client'] = $get_id_client['id_client'];

                    }else{
                        $errors = $client->errors;
                    }
                }else{
                    
                    $_POST['id_client'] = $check_client['id_client'];
                }

                if($location->validate($_POST)){

                    $_POST['date_location'] = date("Y-m-d H:i:s");
                    $_POST['duree_location'] = date_duration($_POST['date_depart'], $_POST['date_retour']);

                    $location->insert($_POST);

                    $this->redirect("locations");
                }else{
                    $errors = $location->errors;
                }
            }
        }else{
            $this->redirect("voitures");
        }

        $this->view('location.add', [
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

                    $location->update($locationId, $_POST);

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