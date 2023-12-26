<?php
require("../../config/config.php");
// session_start();
$userModule = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // if (empty($_POST["Username"]) || empty($_POST["Password"])) {
    //     echo 'Invalid';
    // } else {
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $user = $userModule->SignIn($username);
    if (!empty($user)) {
        if (password_verify($password, $user["password"])) {
            setcookie("username", $username, time() + 86400 * 30);
            setcookie("password", $user["password"], time() + 86400 * 30);
            $_SESSION["username"] = $username;
            $_SESSION["avt"] = $userModule->getAvatarByUsername($username);
            echo 'Valid';
        } else {
            echo 'Invalid';
        }
    } else {
        echo 'Invalid';
    }
    // }
}
