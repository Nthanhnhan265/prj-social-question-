<?php
require_once '../../config/database.php';

if(isset($_POST['id_question'])) {
    $id = $_POST['id_question'];
    $productModel = new HashTag();
    if ($productModel->deleteAllHashtagsByIDQuestion($id_question)) {
        $_SESSION['alert'] = 'd successfully!!!';
    }
    else {
        $_SESSION['alert'] = 'd failed!!!';
    }
    header('location: index.php');
}