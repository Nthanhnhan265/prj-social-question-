<?php 
    include("../config/config.php"); 
    $template=new Template(); 
    $questionModule=new Question(); 
    $questions=$questionModule->getAllQuestions(); 
    $userModule=new User(); 
    $data=[ 
        "title"=>"Home", 
        "slot"=>"This is feature", 
        "slot2"=>$template->Render("question",["questions"=>$questions,"userModule"=>$userModule]) 
    ]; 

    $template->View("home",$data); 

    ?>