<?php

class Archives extends controller
{

    public function index()
    {
        if(!auth::logged_in()) {
            
            $this->redirect('login');
        }

        $user = new User();

        $data = array();
        $searchResults = array();
        $errors = array();

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        if(count($_POST) > 0){
            if($user->searchValidate($_POST)){

                $firstname = (empty($_POST['firstname'])) ? "" : "%".$_POST['firstname']."%";
                $lastname = (empty($_POST['lastname'])) ? "" : "%".$_POST['lastname']."%";

                $date_location_depuis = (empty($_POST['date_location_depuis'])) ? "" : $_POST['date_location_depuis'];
                $date_location_jusqua = (empty($_POST['date_location_jusqua'])) ? "" : $_POST['date_location_jusqua'];

                if(empty($_POST['rank'])){
                    $rank = '';
                }else{
                    if($_POST['rank'] == 'admin'){
                        $rank = 'admin';
                    }elseif($_POST['rank'] == 'agent'){
                        $rank = 'admin';
                    }
                }

                $searchQuery = "SELECT * FROM `locations` JOIN `users` ON locations.creator = users.id_user
                                    WHERE firstname LIKE '$firstname' OR lastname LIKE '$lastname'
                                        OR `rank` = '$rank' OR date_location BETWEEN '$date_location_depuis' AND '$date_location_jusqua' 
                                        limit $limit offset $offset";

                $searchResults = $user->query($searchQuery);
            }else{

                $errors = $user->errors;
                $data = $user->query("SELECT * FROM `locations` JOIN `users` ON locations.creator = users.id_user limit $limit offset $offset;");
            }
            
        }else{

            $data = $user->query("SELECT * FROM `locations` JOIN `users` ON locations.creator = users.id_user limit $limit offset $offset;");
        }

       

        $this->view('archives', [
            'rows' => $data,
            "searchResults" => $searchResults,
            "pager" => $pager,
            "errors" => $errors,
        ]);
    }
}