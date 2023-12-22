<?php 
require("../config/config.php"); 
$questionModule=new Question(); 
$voteModule=new Vote(); 
$response=[]; 

$_SESSION['test']="checked";
if($_SERVER['REQUEST_METHOD']==='POST') { 
    
    try { 
        if(!empty($_SESSION["username"])) { 
            $data=json_decode(file_get_contents('php://input',true)); 
              if(!empty($data)) { 
                 $questionInfo=$questionModule->getQuestionByID($data->id_question); 
                 $id_question=$data->id_question; 
                 $type=$data->type; 
                 $username=$_SESSION["username"]; 
                 //Thêm vào bảng vote nếu chưa vote, hủy nếu đã vote 
                 $voteModule->Vote($id_question,$username,$type);  

                //cập nhật số lượng và gửi về client 
                $questionInfo=$questionModule->getQuestionByID($data->id_question); 
                $response=["success"=>"ok","upvote"=>$questionInfo["upvote"]];
                header("Content-Type:application/json");  
                echo(json_encode($response)); 
             }else { 
                
                 header("Content-Type:application/json");
                 echo(json_encode(["success"=>"ok"])); 
             }
         } else { 
             header("Content-Type:application/json");
             echo(json_encode(["success"=>"ok","status"=>"unidentifiedUser"])); 
         }
     }catch (Throwable $th ) { 
         $_SESSION["err"]=$th; 
     }




}
