<?php

class Entretien extends Model{

    protected $allowedColumns = [
        'voiture',
        'type_entretien',
        'date_entretien',
        'description',
        'prix_entretien',
    ];

    protected $beforeInsert = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        # validate type_entretien
        $type_entretien = ['mechanic', 'videnge'];
        if(empty($data['type_entretien']) || !in_array($data['type_entretien'], $type_entretien)){
            $this->errors['type_entretien'] = "Type d'entretien est invalide !";
        }

        # validate date_entretien
        if(empty($data['date_entretien']) || $data['date_entretien'] > $date ){
            $this->errors['date_entretien'] = "Date d'entretien est invalide !";
        }

        #validate description
        if(empty($data['description'])){
            $this->errors['description'] = "Description d'entretien est vide !";
        }

        # validate prix_entretien
        if(empty($data['prix_entretien'])){
            $this->errors['prix_entretien'] = "Prix d'entretien est vide !";
        }


        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }
}