<?php

class Notifications extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $notificationsVoiture = new Voiture_notification();
        $notificationsLocation = new Location_notification();

        $voitureQuery = 'select * from voiture_notifications where state = :state order by date_notification DESC';
        $locationQuery = 'select * from location_notifications where state = :state order by date_notification DESC';

        $data['notificationsVoiture'] = $notificationsVoiture->query($voitureQuery, ['state' => '1']);
        $data['notificationsLocation'] = $notificationsLocation->query($locationQuery, ['state' => '1']);

        $this->view('notifications',[
            'rows' => $data,
        ]);
        
    }
}