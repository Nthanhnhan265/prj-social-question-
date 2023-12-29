<?php
require('../../config/config.php');
$questionModule = new Question();
$voteModule = new Vote();
$bookmarkModule = new Bookmark();
$hashtagModule = new HashTag();
$imageModule = new Images();
$answerModule = new Answer();
date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('Y-m-d H:m'); 
//kiểm tra trường hợp user đã đăng nhập chưa 
echo($_POST['inputAnswer']); 
if (!empty($_POST['inputAnswer']) && !empty($_POST['id_answer']) && !empty($_SESSION['username'])) {
    $flag = true;
    $id = $_POST['id_answer'];
    $content=$_POST['inputAnswer']; 
    $answer=$answerModule->getAnswerByID($id)[0];
    //kiểm tra trường hợp xem người dùng có phải là author của answer này hay không 
    if($answer['author']==$_SESSION['username']) { 
        //    public function editAnswer($content,$edited_at,$status,$id_answer) { 
        $flag = $answerModule->editAnswer($content,date('Y-m-d H:m'),'answer',$id);
 
        if (!$flag) {
            echo ('sua that bai');
        }else { 
            echo('ok');
            header("location: http://localhost/prj-social-question-/public/personal-info?user=".$_SESSION['username']."&page=answered"); 
        }
        
    }else { 
        header("location: http://localhost/prj-social-question-/public/index.php"); 

    }

}
