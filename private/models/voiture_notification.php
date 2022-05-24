<?php

class Voiture_notification extends Model{

    protected $allowedColumns = [
        'matricule',
        'type_notification',
        'date_notification',
        'next_date',
        'state',
    ];

    protected $beforeInsert = [];

    public function set_voiture_notif($carId, $data)
    {

        // calculate next date assurnce
        $date_assurance = $data['date_assurance'];
        $next_date_assurance = date('Y-m-d', strtotime('+1 year', strtotime($date_assurance)));
        $date_notification_assurance = date('Y-m-d', strtotime('-1 week', strtotime($next_date_assurance)));

        $assurance_arr = array();

        $assurance_arr['matricule'] = $carId;
        $assurance_arr['type_notification'] = 'assurance';
        $assurance_arr['date_notification'] = $date_notification_assurance;
        $assurance_arr['next_date'] = $next_date_assurance;
        $assurance_arr['state'] = '1';

        $this->insert($assurance_arr);

        // calculate next date viniete
        $date_viniete = $data['date_viniete'];
        $next_date_viniete = date('Y-m-d', strtotime('+1 year', strtotime($date_viniete)));
        $date_notification_viniete = date('Y-m-d', strtotime('-1 week', strtotime($next_date_viniete)));

        $viniete_arr = array();

        $viniete_arr['matricule'] = $carId;
        $viniete_arr['type_notification'] = 'viniete';
        $viniete_arr['date_notification'] = $date_notification_viniete;
        $viniete_arr['next_date'] = $next_date_viniete;
        $viniete_arr['state'] = '1';

        $this->insert($viniete_arr);

        // calculate next date videnge
        $videnge = $data['dernier_km'];


    }

    public function update_voiture_notif($carId, $data)
    {
        // calculate next date assurnce
        $date_assurance = $data['date_assurance'];
        $next_date_assurance = date('Y-m-d', strtotime('+1 year', strtotime($date_assurance)));
        $date_notification_assurance = date('Y-m-d', strtotime('-1 week', strtotime($next_date_assurance)));

        $assurance_arr = array();

        $assurance_arr['matricule'] = $carId;
        $assurance_arr['date_notification'] = $date_notification_assurance;
        $assurance_arr['next_date'] = $next_date_assurance;

        $assurance_query = "update voiture_notifications set date_notification = :date_notification , next_date = :next_date where matricule = :matricule && type_notification = 'assurance'";

        $this->query($assurance_query, $assurance_arr);

        // calculate next date viniete
        $date_viniete = $data['date_viniete'];
        $next_date_viniete = date('Y-m-d', strtotime('+1 year', strtotime($date_viniete)));
        $date_notification_viniete = date('Y-m-d', strtotime('-1 week', strtotime($next_date_viniete)));

        $viniete_arr = array();

        
        $viniete_arr['matricule'] = $carId;
        $viniete_arr['date_notification'] = $date_notification_viniete;
        $viniete_arr['next_date'] = $next_date_viniete;

        $assurance_query = "update voiture_notifications set date_notification = :date_notification , next_date = :next_date where matricule = :matricule && type_notification = 'viniete'";

        $this->query($assurance_query, $assurance_arr);

        // calculate next date videnge
        $videnge = $data['derniere_km'];
    }

    public function get_voiture_notif_count()
    {
        $count_notif = 0;
        $dateNow = date("Y-m-d");
        $voitureQuery = 'select * from voiture_notifications where state = :state && date_notification = :dateNow order by date_notification DESC';

        $result = $this->query($voitureQuery, ['state' => '1', 'dateNow' => $dateNow]);

        if($result){
            foreach ($result as $key) {
                $count_notif += 1;
            }
        }

        return $count_notif;
    }

    

}