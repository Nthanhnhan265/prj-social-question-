<?php 
require("../../config/config.php"); 
$type="question"; 
$author="";
$content=""; 
$created_at=date("Y-m-d"); 

$questionModule=new Question(); 
$tagModule=new HashTag(); 

$strHashtag=""; 

if(!empty($_POST["hashtags"])){ 
    $strHashtag=$_POST["hashtags"];  
}

if(!empty($_POST["author"])) { 
    $author=$_POST["author"]; 
    echo("checked"); 
}

if(!empty($_POST["content"])) { 
    $content=$_POST["content"]; 
    echo("checked"); 

}

if(!empty($author) &&!empty($content)) {
    $temp=$questionModule->insertQuestion($content,$type,$created_at,$created_at,$author);  
    if($temp!=false && !empty($strHashtag)) {
        var_dump(explode(',',$strHashtag)); 
        $tagModule->insertHashtagQuestion($temp,explode(',',$strHashtag));
    }
    header("location: http://localhost/prj-social-question/public/index.php") ; 
    // echo($author.$content); 
}else { 
    echo("<h1 style='text-aligns:center'>Thêm thất bại</h1>"); 
}
 