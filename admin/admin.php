<?php
require("../config/config.php");
$userModule = new User();
if (!empty($_SESSION['username']) && $userModule->getUserByUsername($_SESSION['username'])['role']=='admin') {

    $template = new Template();
    $allUsers = $userModule->getAllUsers();
    $perPage = 6;
    $page = 1;
    $numOfPage = ceil(count($allUsers) / $perPage);
    if (!empty($_GET['page'])) {
        $page = (int) $_GET['page'];
    }
    $startPage = ($page - 1) * $perPage;
    $users = $userModule->getUsersInPage($startPage, $perPage);
    
    $data = [
        "title" => "Home",
        "slot" => "",
        "slot2" => $template->Render("user-list", [
            "users" => $users,
            "page" => $page,
            "numOfPage" => $numOfPage
    
        ]),
    
    ];
    
    $template->View("home-admin", $data);
}
else { 
     header('location: http://localhost/prj-social-question-/public/index.php');
}