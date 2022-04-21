<?php

class signup extends controller{

    public function index(){

        $errors = array();

        if(count($_POST) > 0){

            $user = new User();

            if($user->validate($_POST)){

                $user->insert($_POST);

                $this->redirect("login");
            }else{
                $errors = $user->errors;
            }
        }

        $this->view('signup', [
            "errors" => $errors,
        ]);
    }
}