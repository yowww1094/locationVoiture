<?php

class Clients extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $client = new Client();
        $data = array();
        $searchResults = array();
        $errors = array();

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "select * from clients  order by date_added DESC limit $limit offset $offset";

        if(count($_POST) > 0){
            if($client->searchValidate($_POST)){

                $nom = (empty($_POST['nom'])) ? "" : "%".$_POST['nom']."%";
                $prenom = (empty($_POST['prenom'])) ? "" : "%".$_POST['prenom']."%";
                $cin = (empty($_POST['cin'])) ? "" : "%".$_POST['cin']."%";
                $client_phone = (empty($_POST['client_phone'])) ? "" : $_POST['client_phone'];

                $searchQuery = "SELECT * FROM clients WHERE nom LIKE '$nom' OR prenom LIKE '$prenom' OR cin LIKE '$cin' OR client_phone LIKE '$client_phone' limit $limit offset $offset";

                $searchResults = $client->query($searchQuery);
            }else{

                $errors = $client->errors;
                $data = $client->query($query);
            }
            
        }else{

            $data = $client->query($query);
        }

        

        $this->view('clients', 
        [
            'rows' => $data,
            'searchResults' => $searchResults,
            'pager' => $pager,
            'errors' => $errors,
        ]);
    }

    public function edit($clientId = '')
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        if ($clientId == '') {

            $this->redirect("clients");
        }

        $client  = new Client();

        $result = $client->where('id_client', $clientId);

        if($result){

            $data = $result[0];
        }

        $errors = array();
        if(count($_POST) > 0){

            #extracting images
            if(count($_FILES) > 0){

                $error = array();

                if($_FILES['cin_img'] && $_FILES['permis_img']){
                    foreach($_FILES as $key => $file){

                        $_POST[$key] = upload_image($file);
                        array_push($errors, $error);
                    }
                }
            }
            if($client->validate($_POST)){
                
                $client->update('id_client', $clientId, $_POST);

                $this->redirect('clients');

            }else{
                $errors = $client->errors;
            }
        }

        $this->view('clients.edit', 
        [
            'rows' => $data,
            'errors' => $errors,
        ]);
    }
}