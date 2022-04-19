<?php

class signup extends controller{

    public function index(){

        $errors = array();

        if(count($_POST) > 0){

            $user = new User();

            if($user->validate($_POST)){

                $arr['firstname'] = $_POST['firstname'];
                $arr['lastname'] = $_POST['lastname'];
                $arr['email'] = $_POST['email'];
                $arr['password'] = $_POST['password'];
                $arr['gender'] = $_POST['gender'];
                $arr['rank'] = $_POST['rank'];

                $user->insert($arr);

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