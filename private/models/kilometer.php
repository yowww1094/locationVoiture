<?php

class Kilometer extends Model{

    protected $allowedColumns = [
        'matricule',
        'last_kilometer',
        'date_added',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        # validate last_kilometer
        if(empty($data['last_kilometer'])){
            $this->errors['marque'] = "Derniere Kilometer du voiture est vide !";
        }


        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }
}