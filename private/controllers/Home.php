<?php

class Home extends controller{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $this->view('home');
    }
}