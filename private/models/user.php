<?php

class User extends Model{

    protected $allowedColumns = [
        'name',
    ];

    protected $beforInsert = [
        'hash_password',
    ];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        # validate firstname
        if(empty($data['firstname']) || !preg_match('/^[a-zA-Z]$/', $data['firstname'])){
            $this->errors['firstname'] = "Only letters allowed in first name!";
        }

        # validate lastname
        if(empty($data['lastname']) || !preg_match("/^[a-zA-Z]$/", $data['lastname'])){
            $this->errors['lastname'] = "Only letters allowed in last name!";
        }

        # validate email
        if(empty($data['email']) || filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "E-mail is not valid!";
        }

        # validate passwords
        if(empty($data['password']) || $data['password'] != $data['password2']){
            $this->errors['password'] = "Passwords doesn't match!";
        }

        if(strlen($data['password']) <= 8){
            $this->errors['password'] = "Passwords must be at least 8 characters long!";
        }

        //return false;
    }

    public function make_user_id($data){

        //$data['user_id'] = $this->randomString(60);
        return $data;

    }

    public function hash_password($data){

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function randomString($length){
        # code...
        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','b','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);
        $text = '';

        for ($i=0 ; $i < $length ; $i++ ) { 
            # code...
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }
}