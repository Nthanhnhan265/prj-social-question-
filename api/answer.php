<?php 
require('../config/config.php'); 
$ansModule=new Answer(); 
if($_SESSION['username'] && $_SERVER['REQUEST_METHOD']==='GET') { 
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case 'get-all-answers':
                $id_question=$_GET["id"];
                $data=$ansModule->getAllAnswersByQuestion($_SESSION["username"],$id_question);
                header('Content-Type:application/json'); 
                echo(json_encode($data)); 
                break; 

           
        }
        
    }else { 
        http_response_code(404);
        echo json_encode(['error' => 'Invalid request']);
    }


}else if($_SESSION['username'] && $_SERVER['REQUEST_METHOD']==='POST') {
     
    

}
