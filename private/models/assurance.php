<?php

class Assurance extends Model{

    protected $allowedColumns = [
        'matricule',
        'numero',
        'agence',
        'date_added',
        'date_debut',
        'date_fin',
        'prix',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        # validate numero
        if(empty($data['numero'])){
            $this->errors['numero'] = "Numero d'assurance est vide !";
        }

        # validate agence
        if(empty($data['agence'])){
            $this->errors['agence'] = "Agence d'assurance est vide !";
        }

        #validate date_debut
        if(empty($data['date_debut'])){
            $this->errors['date_debut'] = "Date debut d'assurance du voiture est invalide !";
        }

        #validate date_fin
        if(empty($data['date_fin'])){
            $this->errors['date_fin'] = "Date fin d'assurance du voiture est invalide !";
        }

        # validate prix
        if (empty($data['prix'])) {
            $this->errors['prix'] = "Prix d'assurance est invalide !";
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function searchValidate($data)
    {
        # code...
        $this->errors = array();

        if(empty($data['marque']) && empty($data['model']) && empty($data['matricule']) && empty($data['date_assurance_depuis']) 
            && empty($data['date_assurance_jusqua']))
        {
            $this->errors['error'] = "Vous devez remplir les champs pour rechercher!";
        }       

        if (count($this->errors) > 0) {
            
            return false;
        }

        return true;
    }
}