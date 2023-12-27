<?php
require("../config/config.php");
$questionModule = new Question();
$userModule = new User();
if (!empty($_SESSION['username']) && $userModule->getUserByUsername($_SESSION['username'])['role'] == 'admin') {

    $page = 1;
    $perPage = 6;
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];

    }
    $allQuestions = $questionModule->getAllQuestions();
    // var_dump(count($allQuestions)); 

    $startPage = ceil($page - 1) * $perPage;
    $numOfPage = ceil(count($allQuestions) / $perPage);
    $questions = $questionModule->getQuestionsInPage($startPage, $perPage);
    $template = new Template();
    $data = [
        "title" => "Questions",
        "slot" => "",
        "slot2" => $template->Render("question-list", [
            "questions" => $questions,
            "numOfPage" => $numOfPage,
            "page" => $page
        ]),

    ];

    $template->View("home-admin", $data);
} else {
    header('location: http://localhost/prj-social-question/public/index.php');
}