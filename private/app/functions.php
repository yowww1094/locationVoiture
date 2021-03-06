<?php

function get_var($key, $default = ''){
    if(isset($_POST[$key])){
        
        return $_POST[$key];
    }

    return $default;
}

function get_select($key, $value){
    if (isset($_POST[$key])) {
        # code...
        if ($_POST[$key] == $value) {
            # code...
            return "selected";
        }
    }

    return "";
}

function get_img($key){
    if(isset($_POST[$key])){
        
        return $_POST[$key];
    }

    return "";
}

function esc($var){
    return htmlspecialchars($var);
}

function randomString($length){
    # code...
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','b','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);
    $text = '';

    for ($i=0 ; $i < $length ; $i++ ) { 
        # code...
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}

function upload_image($image){

    $ext = explode('.', $image['name']);
    $image_ext = strtolower(end($ext));

    $allowed = array('jpeg','png','jpg');

    if (in_array($image_ext, $allowed)){

        if ($image['error'] == 0 ) {
            
            if($image['size'] < 500000 ){

                $image_name = uniqid("IMG-", true) . '.' . $image_ext;
                $folder = 'uploads/';

                if(!file_exists($folder)){
                    mkdir($folder, 0777, true);
                }

                $destination = $folder . $image_name;
                move_uploaded_file($image['tmp_name'], $destination);

                return $destination;

            }else{
                $error['size'] = "La taille de l'image est trop grande";
            }
        }else{
            $error['error'] = "Une erreur s'est produite lors de l'envoie de l'image";
        }
    }else{
        $error['type'] = "Type d'image n'est pas valide";
    }
}

function date_duration($date1, $date2){

	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
    
	$interval = $date1->diff($date2);

	return $interval->days;
}

function get_date($date){
    
    return date("j M, Y",strtotime($date));
}

function show($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>'; 
}

function fix_length($string){
    return $string;
}