<?php 
require('../config/config.php'); 
$ansModule=new Answer(); 
if( $_SERVER['REQUEST_METHOD']==='GET') { 
    if(!empty($_GET["action"])) {
        //kiểm tra xem user đã đăng nhập chưa 
        if(!empty($_SESSION['username'])) { 
            switch($_GET["action"]) {
                case 'get-all-answers':
                    $id_question=$_GET["id"];
                    $recentIDs=[]; 
                    $data=$ansModule->getAllAnswersByQuestion($_SESSION["username"],$id_question);
                    header('Content-Type:application/json'); 
                    if(!empty($_COOKIE['recentIDs'])) { 
                        //tra ve 1 mang 
    
                        $recentIDs=unserialize($_COOKIE['recentIDs']);
                        if(!in_array($id_question,$recentIDs)) { 
                            array_push($recentIDs,$id_question);
                        }else { 
                            array_shift($recentIDs);
                            array_push($recentIDs,$id_question);
                        }
                    }else { 
                        array_push($recentIDs,$id_question); 
                    }
                    $recentIDs=serialize($recentIDs); 
                    setcookie('recentIDs',$recentIDs,time()+ 86400*30,"/"); 
                    echo(json_encode($data)); 
                    break; 
    
               

        }
        }
        //Trường hợp chưa đăng nhập
        else { 
            switch($_GET["action"]) {
                case 'get-all-answers':
                    $id_question=$_GET["id"];
                    $recentIDs=[]; 
                    $data=$ansModule->getAllAnswersByQuestionWithoutSignIn($id_question);
                    header('Content-Type:application/json'); 
                    // if(!empty($_COOKIE['recentIDs'])) { 
                    //     //tra ve 1 mang 
    
                    //     $recentIDs=unserialize($_COOKIE['recentIDs']);
                    //     if(!in_array($id_question,$recentIDs)) { 
                    //         array_push($recentIDs,$id_question);
                    //     }else { 
                    //         array_shift($recentIDs);
                    //         array_push($recentIDs,$id_question);
                    //     }
                    // }else { 
                    //     array_push($recentIDs,$id_question); 
                    // }
                    // $recentIDs=serialize($recentIDs); 
                    // setcookie('recentIDs',$recentIDs,time()+ 86400*30,"/"); 
                    echo(json_encode($data)); 
                    break; 
    
               

        }
        }
        
    }else { 
        http_response_code(404);
        echo json_encode(['error' => 'Invalid request']);
    }


}else if(!empty($_SESSION['username']) && $_SERVER['REQUEST_METHOD']==='POST') {
     
    

}
