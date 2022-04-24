<?php

class Location extends Model{

    protected $allowedColumns = [
        'id_client',
        'matricule',
        'date_location',
        'date_depart',
        'date_retour',
        'duree_location',
        'prix',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_voiture',
        'get_client',
    ];

    public function validate($data)
    {
        # code...
        $this->errors = array();

        $date = date("Y-m-d H:i:s");

        #validate date_depart
        if(empty($data['date_depart']) || $data['date_depart'] < $date ){
            $this->errors['date_depart'] = "Date depart de location est invalide !";
        }

        #validate date_retour
        if(empty($data['date_retour']) || ($data['date_retour'] < $date && $data['date_retour'] < $data['date_depart']) ){
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

    public function get_voiture($data)
    {
        $user = new Voiture();
        if(is_array($data)){
            foreach($data as $key => $row){

                $result = $user->where('matricule', $row->matricule);
                $data[$key]->voiture = is_array($result) ? $result[0] : false;
            }
        }
        
        return $data;
    }

    public function get_client($data)
    {
        $client = new Client();
        if(is_array($data)){
            foreach($data as $key => $row){

                $result = $client->where('id_client', $row->id_client);
                $data[$key]->client = is_array($result) ? $result[0] : false;
            }
        }
        
        return $data;
    }
}