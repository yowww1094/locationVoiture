<?php

class Client extends Model{

    protected $allowedColumns = [
        'nom',
        'prenom',
        'cin',
        'cin_img',
        'permis_img',
        'client_phone',
        'date_added',
    ];

    protected $beforeInsert = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        # validate firstname
        if(empty($data['prenom']) || preg_match('/[^a-zA-Z]$/', $data['prenom'])){
            $this->errors['prenom'] = "Seules les lettres sont autorisées dans le prénom !";
        }

        # validate lastname
        if(empty($data['nom']) || preg_match("/[^a-zA-Z]$/", $data['nom'])){
            $this->errors['nom'] = "Seules les lettres sont autorisées dans le nom !";
        }

        # validate cin
        if(empty($data['nom'])){
            $this->errors['nom'] = "CIN est vide !";
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