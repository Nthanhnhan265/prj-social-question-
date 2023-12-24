<?php 
require('../config/config.php'); 
$questionModule=new Question(); 
$answerModule=new Answer();
$vote=new Vote(); 

$type='upvote'; 
$type2='downvote'; 
$voteInfo='downvote';
$id_answer='28';
// if($type=="upvote" && $voteInfo=="downvote") { 
//     //giảm số lượng vote của câu hỏi đó 
//    $answerInfo=$answerModule->getAnswerByID($id_answer); 
//    $answerModule->minusVote($id_answer,$voteInfo); //giảm số lượng cái cũ 
//    $answerModule->addVote($id_answer,$type); //giảm số lượng cái cũ 

// } 
$vote->editVoteAnswer($id_answer,'nhan',$type); 


var_dump($answerModule->getAnswerByID($id_answer));