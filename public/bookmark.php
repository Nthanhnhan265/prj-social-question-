<?php 
    include("../config/config.php"); 
    $template=new Template(); 

    $data=[ 
        "title"=>"Home", 
        "slot"=>"This is feature of bookmark", 
        "slot2"=>"Bookmark page" 
    ]; 

    $template->View("home",$data); 