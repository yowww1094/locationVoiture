<?php

class Location extends Model{

    protected $allowedColumns = [
        'client',
        'voiture',
        'date_location',
        'date_depart',
        'date_retour',
        'duree_location',
        'prix',
    ];

    protected $beforeInsert = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        #validate date_depart
        if(empty($data['date_depart']) || $data['date_depart'] > $date ){
            $this->errors['date_depart'] = "Date depart de location est invalide !";
        }

        #validate date_retour
        if(empty($data['date_retour']) || ($data['date_retour'] > $date && $data['date_retour'] > $data['date_depart']) ){
            $this->errors['date_retour'] = "Date retour du  est invalide !";
        }

        # validate prix
        if(empty($data['prix'])){
            $this->errors['prix'] = "Prix de location est invalide !";
        }        

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }
}