<?php

class Notifications extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $notificationsVoiture = new Voiture_notification();
        $notificationsLocation = new Location_notification();

        $dateNow = date("Y-m-d");

        $voitureQuery = 'select * from voiture_notifications where state = :state && date_notification = :dateNow order by date_notification DESC';
        $locationQuery = 'select * from location_notifications where state = :state && date_notification = :dateNow order by date_notification DESC';

        $data['notificationsVoiture'] = $notificationsVoiture->query($voitureQuery, ['state' => '1', 'dateNow' => $dateNow]);
        $data['notificationsLocation'] = $notificationsLocation->query($locationQuery, ['state' => '1', 'dateNow' => $dateNow]);

        $this->view('notifications',[
            'rows' => $data,
        ]);
        
    }
}