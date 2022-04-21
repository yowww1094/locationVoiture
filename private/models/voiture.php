<?php

class Voiture extends Model{

    protected $allowedColumns = [
        'matricule',
        'marque',
        'model',
        'date_added',
        'date_assurance',
        'date_viniete',
        'dernier_km',
        'image_voiture',
    ];

    protected $beforeInsert = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        # validate matricule
        if(empty($data['matricule'])){
            $this->errors['mareicule'] = "Matricule du voiture est vide !";
        }

        # validate marque
        if(empty($data['marque'])){
            $this->errors['marque'] = "Marque du voiture est vide !";
        }

        # validate model
        if(empty($data['model'])){
            $this->errors['model'] = "Model du voiture est vide !";
        }

        #validate date_assurance
        if(empty($data['date_assurance']) || $data['date_assurance'] > $date ){
            $this->errors['date_assurance'] = "Date d'assurance du voiture est invalide !";
        }

        #validate date_viniete
        if(empty($data['date_viniete']) || $data['date_viniete'] > $date ){
            $this->errors['date_viniete'] = "Date de viniete du voiture est invalide !";
        }

        # validate dernire_km
        if(empty($data['dernire_km']) || !is_int($data['dernire_km']) ){
            $this->errors['dernire_km'] = "Dernier kilometrage du voiture est invalide !";
        }
        
        # validate image_voiture
        

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }
}