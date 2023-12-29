<?php
require('../../config/config.php');
$questionModule = new Question();
$voteModule = new Vote();
$bookmarkModule = new Bookmark();
$hashtagModule = new HashTag();
$imageModule = new Images();
$answerModule = new Answer();


if (!empty($_POST['id_question'])) {
    $flag = true;
    $id_question = $_POST['id_question'];
    echo($id_question);
    $question=$questionModule->getQuestionById($id_question);
    if($question['author']==$_SESSION['username']) { 
        //xóa questions 
        $flag = $questionModule->deleteQuesiton($id_question);
    
        //images
        $flag = $imageModule->deleteImagesByID_question($id_question);
    
        //xóa bookmark của bài viết 
        $flag = $bookmarkModule->delBookmark($_SESSION['username'], $id_question);
    
        //xóa hashtag-question
        $flag = $hashtagModule->deleteAllHashtagsByIDQuestion($id_question);
    
        //xóa vote question 
        $flag = $voteModule->deleteVote($_SESSION['username'], $id_question);
    
        //xoa tat ca answer cua bai viet 
        // $flag =$ansModule->deleteAnswersOfQuestion($id_question);
        if (!$flag) {
            echo ('xoa that bai');
        }else { 
            echo('ok');
            header("location: http://localhost/prj-social-question-/public/personal-info?user=".$_SESSION['username']."&page=asked"); 
        }
        
    }else { 
        header("location: http://localhost/prj-social-question-/public/personal-info?user=".$_SESSION['username']."&page=asked"); 

    }

}
