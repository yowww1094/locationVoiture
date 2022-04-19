<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class User extends Model{

    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
    ];

    protected $beforeInsert = [
        'hash_password',
    ];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        # validate firstname
        if(empty($data['firstname']) || preg_match('/^[a-zA-Z]$/', $data['firstname'])){
            $this->errors['firstname'] = "Seules les lettres sont autorisées dans le prénom !";
        }

        # validate lastname
        if(empty($data['lastname']) || preg_match("/^[a-zA-Z]$/", $data['lastname'])){
            $this->errors['lastname'] = "Seules les lettres sont autorisées dans le nom !";
        }

        # validate email
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "L'email n'est pas valide!";
        }

        #validate gender
        $genders = ['male', 'female'];
        if(empty($data['gender']) || !in_array($data['gender'], $genders) ){
            $this->errors['gender'] = "Le sexe n'est pas valide !";
        }

        #validate rank
        $ranks = ['agent', 'admin'];
        if(empty($data['gender']) || !in_array($data['rank'], $ranks) ){
            $this->errors['rank'] = "Le rang n'est pas valide !";
        }

        # validate passwords
        if(empty($data['password']) || $data['password'] != $data['password2']){
            $this->errors['password'] = "Les mots de passe ne correspondent pas !";
        }

        if(strlen($data['password']) < 8){
            $this->errors['password'] = "Les mots de passe doivent comporter au moins 8 caractères !";
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function make_user_id($data){

        //$data['user_id'] = $this->randomString(60);
        return $data;

    }

    public function hash_password($data){

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }
}