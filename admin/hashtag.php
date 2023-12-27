<?php
require("../config/config.php");
$tagModule = new HashTag();
$template = new Template();
$userModule = new User();
if (!empty($_SESSION['username']) && $userModule->getUserByUsername($_SESSION['username'])['role'] == 'admin') {

    $perPage = 6;
    $page = 1;
    $allTags = $tagModule->getAllTags();
    $numOfPage = ceil(count($allTags) / $perPage);
    if (!empty($_GET['page'])) {
        $page = (int) $_GET['page'];
    }
    $startPage = ($page - 1) * $perPage;
    $tags = $tagModule->getTagsInPage($startPage, $perPage);

    $data = [
        "title" => "Questions",
        "slot" => "",
        "slot2" => $template->Render("tag-list", [
            "tags" => $tags,
            "page" => $page,
            "numOfPage" => $numOfPage

        ]),

    ];

    $template->View("home-admin", $data);
} else {
    header('location: http://localhost/prj-social-question/public/index.php');
}
