<?php

function get_var($key){
    if(isset($_POST[$key])){
        
        return $_POST[$key];
    }

    return "";
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

function extract_image($image){
       
}

function date_duration($date1, $date2){

	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
    
	$interval = $date1->diff($date2);

	return $interval->days;
}