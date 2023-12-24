<?php
require("../config/config.php");

$ansModule=new Answer(); 
if($_SESSION['username'] && $_SERVER['REQUEST_METHOD']==='POST') { 
    $data=json_decode(file_get_contents('php://input'),true);
    if(!empty($data)) {
        $id_question=$data['id_question'];
        $content=$data["content"];
        $_SESSION['test']=$content; 
        date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        $created_at=date("Y-m-d H:i"); 

        //xử lý trả về thông tin câu hỏi khi đã có id 
        //$content,$author,$created_at,$edited_at,$status,$id_quesion
        $id=$ansModule->insertAnswer($content,$_SESSION["username"],$created_at,$created_at,"answer",$id_question);
        $respone=[]; 
        if($id!=false) { 
            $respone=$ansModule->getAllAnswersByQuestion($_SESSION['username'],$id_question);
        }        
        else { 
            $respone=["status"=> "failed"];
        }


        header('Content-Type:application/json'); 
        echo(json_encode($respone)); 
    }


} else {     
    header('Content-Type:application/json'); 
    echo(json_encode(["status"=>"failed:undefinedUser or invalid http method"])); 

}