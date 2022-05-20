<?php

class Entretien extends Model{

    protected $allowedColumns = [
        'matricule',
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

    public function searchValidate($data)
    {
        # code...
        $this->errors = array();

        $type_entretien = ['mechanic', 'videnge'];
        if(empty($data['marque']) && empty($data['model']) && empty($data['matricule']) && !in_array($data['type_entretien'], $type_entretien)
             && empty($data['dateMin']) &&empty($data['dateMax']) &&empty($data['prixMin']) &&empty($data['prixMax']))
        {

            $this->errors['error'] = "Vous devez remplir les champs pour rechercher!";
        }       

        if (count($this->errors) > 0) {
            
            return false;
        }

        return true;
    }
}