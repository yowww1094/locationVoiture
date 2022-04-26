<?php

class Clients extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $client = new Client();

        $data = $client->orderBy('date_added', 'DESC');

        $this->view('clients', 
        [
            'rows' => $data,
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

                $_POST['cin_img'] = extract_image($_FILES['cin_img']);
                $_POST['permis_img'] = extract_image($_FILES['permis_img']);

            }

            if($client->validate($_POST)){

                $client->update('client_id', $clientId, $_POST);

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