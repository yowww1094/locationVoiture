<?php

class Voiture extends Model{

    protected $allowedColumns = [
        'matricule',
        'marque',
        'model',
        'viniete',
        'date_added',
        'image_voiture',
        'state',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_entretiens',
        'get_assurance',
        'get_kilometer',
    ];

    public function validate($data)
    {
        # code...
        $this->errors = array();

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

        # validate viniete
        if(empty($data['viniete'])){
            $this->errors['viniete'] = "Date viniete du voiture est vide !";
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
            && empty($data['date_assurance_jusqua']) && empty($data['date_viniete_depuis']) && empty($data['date_viniete_jusqua']) && !in_array($data['state'],['disponible','location']))
        {

            $this->errors['error'] = "Vous devez remplir les champs pour rechercher!";
        }       

        if (count($this->errors) > 0) {
            
            return false;
        }

        return true;
    }

    public function get_entretiens($data)
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

    public function get_assurance($data)
    {

        $assurances = new Assurance();
        if(is_array($data)){
            foreach($data as $key => $row){

                $query = 'select * from assurances where matricule =:matricule order by date_added desc';

                $result = $assurances->query($query , ['matricule' => $row->matricule,]);
                $data[$key]->assurances = is_array($result) ? $result[0] : false;
            }
        }
        
        return $data;
    }

    public function get_kilometer($data)
    {

        $kilometers = new Kilometer();
        if(is_array($data)){
            foreach($data as $key => $row){

                $query = 'select * from kilometers where matricule =:matricule order by date_added desc';

                $result = $kilometers->query($query , ['matricule' => $row->matricule]);
                $data[$key]->kilometers = is_array($result) ? $result[0] : false;
            }
        }
        
        return $data;
    }
}