<?php
require("../config/config.php"); 
$username="";
$password=""; 
$joinAt=date("Y-m-d"); 
$description="";
$firstname=""; 
$lastname=""; 
$avatar=""; 
$userModule=new User(); 



if(!empty($_POST["username"])) { 
    $username=$_POST["username"]; 
}


if(!empty($_POST["password"])) { 
    $password=$_POST["password"]; 

}


if(!empty($_POST["lastname"])) { 
    $lastname=$_POST["lastname"]; 
}

if(!empty($_POST["firstname"])) { 
    $firstname=$_POST["firstname"]; 
}

//nhớ ràng buộc trước khi thêm vào 
if($userModule->SignUp($username,$password,$joinAt,$description,$firstname,$lastname,$avatar)) { 
    header("location: http://localhost/prj-social-question/public/index.php"); 
} else { 
    echo("Tài khoản đã tồn tại"); 
}


