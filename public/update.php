<?php
require_once ('../config/config.php');
$username = '';
$firstName = '';
$lastName = '';
$avatar = '';


if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
}
if (isset($_POST['lastName'])) {
    $lastName = $_POST['lastName'];
}
if (isset($_POST['avatar'])) {
    $avatar = $_POST['avatar'];
}


if(!empty($username) && !empty($firstName) && !empty($lastName) && !empty($avatar)) {
    $user = new User();
    if($productModel->update($username, $firstName, $lastName, $avatar))
     {
        header('location: http://http://localhost/prj-social-question-/public/');
    }
}