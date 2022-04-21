<?php

class Clients extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $client = new Client();

        $data = $client->findAll();

        $this->view('clients', 
        [
            'data' => $data,
        ]);
    }

    public function edit($clientId)
    {
        if (isset($clientId)) {
            
            if(count($_POST) > 0){

                $client  = new Client();

                #extracting images
                if(count($_FILES) > 0){

                    $_POST['cin_img'] = extract_image($_FILES['cin_img']);
                    $_POST['permis_img'] = extract_image($_FILES['permis_img']);
                }

                if($client->validate($_POST)){

                    $client->update($clientId, $_POST);


                }else{
                        $errors = $client->errors;
                }
            }
        }else{

            $this->redirect("clients");
        }
    }
}