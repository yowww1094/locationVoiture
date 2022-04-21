<?php

class Client extends Model{

    protected $allowedColumns = [
        'nom',
        'prenom',
        'cin_img',
        'permis_img',
        'phone',
        'date_added',
    ];

    protected $beforeInsert = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        # validate firstname
        if(empty($data['firstname']) || preg_match('/[^a-zA-Z]$/', $data['firstname'])){
            $this->errors['firstname'] = "Seules les lettres sont autorisées dans le prénom !";
        }

        # validate lastname
        if(empty($data['lastname']) || preg_match("/[^a-zA-Z]$/", $data['lastname'])){
            $this->errors['lastname'] = "Seules les lettres sont autorisées dans le nom !";
        }

        # validate cin_img

        #validate permis_img

        # validate phone
        if(empty($data['client_phone'])){
            $this->errors['client_phone'] = "Numero de telephone du client est vide !";
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

}