<?php 
    include("../config/config.php"); 
    $template=new Template(); 

    $data=[ 
        "title"=>"Notification", 
        "slot"=>"This is feature of notification page", 
        "slot2"=>"This is notification page" 
    ]; 

    $template->View("home",$data); 
