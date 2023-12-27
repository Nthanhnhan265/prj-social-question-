<?php
require('../config/config.php');

$voteModule = new Vote();
$answerModule = new Answer();
// $voteModule->VoteAnswer('28','test','downvote'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['username'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data['action'] === 'upvote') {
        $voteModule->VoteAnswer($data['id_answer'], $_SESSION['username'], 'upvote');
        $ansInfo = $answerModule->getAnswerByID((int) $data['id_answer']);
        header("Content-Type:Application/json");
        echo (json_encode(['upvote' => $ansInfo[0]['upvote']]));


    } else if ($data['action'] === 'downvote') {
        $voteModule->VoteAnswer($data['id_answer'], $_SESSION['username'], 'downvote');
        $ansInfo = $answerModule->getAnswerByID((int) $data['id_answer']);
        header("Content-Type:Application/json");
        echo (json_encode(['upvote' => $ansInfo[0]['upvote']]));
    } else {
        http_response_code(404);
        echo (json_encode(['status' => 'invalid']));
    }








} else {
    http_response_code(404);
    echo (json_encode(['status' => 'invalid']));
}