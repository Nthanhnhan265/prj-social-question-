<?php
require_once '../../config/database.php';

if(isset($_POST[' id_answer'])) {
    $id = $_POST[' id_answer'];
    $productModel = new Answer();
    if ($productModel->deleteAnswer($id)) {
        $_SESSION['alert'] = 'd successfully!!!';
    }
    else {
        $_SESSION['alert'] = 'd failed!!!';
    }
    header('location: index.php');
}