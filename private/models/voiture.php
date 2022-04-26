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
        'state',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_entretien',
    ];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d");

        # validate matricule
        if(empty($data['matricule']) || preg_match('/\//', $data['matricule'])){
            $this->errors['matricule'] = "Matricule du voiture est invalide !";
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
        if (empty($data['dernier_km'])) {
            $this->errors['dernier_km'] = "Dernirer kilometrage du voiture est invalide !";
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function get_entretien($data)
    {

        $entretien = new Entretien();
        if(is_array($data)){
            foreach($data as $key => $row){

                $result = $entretien->where('matricule', $row->matricule);
                $data[$key]->entretien = is_array($result) ? $result : false;
            }
        }
        
        return $data;
    }
}