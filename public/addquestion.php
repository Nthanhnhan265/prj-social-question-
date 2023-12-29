<?php 
require("../config/config.php"); 
$type="question"; 
$author="";
$content=""; 
$created_at=date("Y-m-d"); 

$questionModule=new Question(); 
if(!empty($_POST["author"])) { 
    $author=$_POST["author"]; 
    echo("checked"); 
}

if(!empty($_POST["content"])) { 
    $content=$_POST["content"]; 
    echo("checked"); 

}
if(!empty($author) &&!empty($content) && 
$questionModule->insertQuestion($content,$type,$created_at,$created_at,$author)) { 
    header("location: http://localhost/prj-social-question/public/index.php") ; 
    // echo($author.$content); 
}else { 
    echo("<h1 style='text-aligns:center'>Thêm thất bại</h1>"); 
}
 