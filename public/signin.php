<?php 
require("../config/config.php"); 
$username=""; 
$password=""; 
$userModule=new User(); 


if(!empty($_POST["username"])) { 
  $username=$_POST["username"]; 
}

if(!empty($_POST["password"])) { 
  $password=$_POST["password"]; 

}

$user=$userModule->SignIn($username); 
if(!empty($user)) { 
  if(password_verify($password,$user["password"])) { 
    setcookie("username",$username,time()+86400*30); 
    setcookie("password",$user["password"],time()+86400*30); 
    $_SESSION["username"]=$username; 
    $_SESSION["password"]=$password; 
    header("location: http://localhost/prj-social-question/public/index.php"); 
  }else { 
    echo("Sai"); 
  }
}else { 
  echo("NO"); 
}
