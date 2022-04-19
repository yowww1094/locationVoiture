<?php

class Home extends controller{

    //protected $table = 'test';
    public function index()
    {
        $user = new User();

        //$arr['name'] = 'update test';

        //$user->insert($arr);
        //$user->update(5, $arr);
        //$user->delete($arr);


        $data = $user->findALl();

        $this->view('home', 
        [
            'data' => $data,
        ]);
    }
}