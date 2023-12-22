<?php 
require('../config/config.php'); 
$ansModule=new Answer(); 
if($_SESSION['username'] && $_SERVER['REQUEST_METHOD']==='POST') { 
    $data=json_decode(file_get_contents('php://input'),true);
    if(!empty($data)) {
        $id_question=$data['id_question'];
        
        //xử lý trả về thông tin câu hỏi khi đã có id 
        $data=$ansModule->getAllAnswersByQuestion($id_question);
        



        header('Content-Type:application/json'); 
        echo(json_encode($data)); 
    }


}
