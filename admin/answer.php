<?php
require("../config/config.php");
$userModule = new User();
if (!empty($_SESSION['username']) && $userModule->getUserByUsername($_SESSION['username'])['role'] == 'admin') {

    $answerModule = new Answer();
    $template = new Template();

    $perPage = 6;
    $page = 1;
    $allAnswers = $answerModule->getAllAnswers();
    $numOfPage = ceil(count($allAnswers) / $perPage);
    if (!empty($_GET['page'])) {
        $page = (int) $_GET['page'];
    }
    $startPage = ($page - 1) * $perPage;
    $answers = $answerModule->getAnswerInPage($startPage, $perPage);


    $data = [
        "title" => "Questions",
        "slot" => "",
        "slot2" => $template->Render("answer-list", [
            "answers" => $answers,
            "page" => $page,
            "numOfPage" => $numOfPage
        ]),

    ];

    $template->View("home-admin", $data);
} else {
    header('location: http://localhost/prj-social-question/public/index.php');
}