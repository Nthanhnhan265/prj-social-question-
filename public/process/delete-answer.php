<?php
require('../../config/config.php');
$questionModule = new Question();
$voteModule = new Vote();
$bookmarkModule = new Bookmark();
$hashtagModule = new HashTag();
$imageModule = new Images();
$answerModule = new Answer();


var_dump($_POST['id_answer']);
if (!empty($_POST['id_answer']) && !empty($_SESSION['username'])) {
    $flag = true;
    $id = $_POST['id_answer'];
    $answer=$answerModule->getAnswerByID($id)[0];
    if($answer['author']==$_SESSION['username']) { 
        //xóa answer 
        $flag=$answerModule->deleteAnswer($id);  
        //xoa vote 
        $flag=$voteModule->deleteVoteAnswer($id,$_SESSION['username']);



        if (!$flag) {
            echo ('xoa that bai');
        }else { 
            echo('ok');
            header("location: http://localhost/prj-social-question-/public/personal-info?user=".$_SESSION['username']."&page=answered"); 
        }
        
    }else { 
        header("location: http://localhost/prj-social-question-/public/index.php"); 

    }

}
