<?php

class Notifications extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $notificationsVoiture = new Notificationsvoitures();
        $notificationsLocation = new Notificationslocations();

        $data['notificationsVoiture'] = $notificationsVoiture->findAll();
        $data['notificationsLocation'] = $notificationsLocation->findAll();


        $this->view('notifications',[
            'rows' => $data,
        ]);
    }
}