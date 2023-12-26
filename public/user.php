<?php 
require('../config/config.php');
$template =new Template(); 
$userModule=new User(); 
$user=$userModule->getUserByUsername($_SESSION['username']); 

$data=[ 
    "title"=>"Home", 
    "slot"=>"this is feature" , 
    "slot2"=>$template->Render("edit-user",["user"=>$user])
]; 

$template->View("home",$data);