<?php

class Location_notification extends Model{

    protected $allowedColumns = [
        'id_location',
        'type_notification',
        'date_notification',
        'state',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_location',
    ];

    public function set_location_notif($locationId, $data)
    {

        // notification date reservation
        $date_depart = $data['date_depart'];
        $date_notification_depart = date('Y-m-d', strtotime('-1 day', strtotime($date_depart)));

        $reservation_arr = array();

        $reservation_arr['id_location'] = $locationId;
        $reservation_arr['type_notification'] = 'reservation';
        $reservation_arr['date_notification'] = $date_notification_depart;
        $reservation_arr['state'] = '1';

        $this->insert($reservation_arr);

        // notification date retour
        $date_retour = $data['date_retour'];
        $date_notification_retour = date('Y-m-d', strtotime('-1 week', strtotime($date_retour)));

        $retour_arr = array();

        $retour_arr['matricule'] = $locationId;
        $retour_arr['type_notification'] = 'retour';
        $retour_arr['date_notification'] = $date_notification_retour;
        $retour_arr['state'] = '1';

        $this->insert($retour_arr);

    }

    public function get_location_notif_count()
    {
        $count_notif = 0;
        $locationQuery = 'select * from location_notifications where state = :state order by date_notification DESC';

        $result = $this->query($locationQuery, ['state' => '1']);

        if($result){
            foreach ($result as $key) {
                $count_notif += 1;
            }
        }
        
        return $count_notif;
    }

    public function get_location($data)
    {
        $location = new Location();
        if(is_array($data)){
            foreach($data as $key => $row){

                $result = $location->where('id_location', $row->id_location);
                $data[$key]->location = is_array($result) ? $result[0] : false;
            }
        }
        
        return $data;
    }


}