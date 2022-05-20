<?php

class Home extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $notificationsVoiture = new Voiture_notification();
        $locations = new Location();

        $data['notificationsVoiture'] = $notificationsVoiture->findAll();
        $data['location'] = $locations->findAll();

        $this->view('home',[
            'data' => $data,
        ]);
    }
}