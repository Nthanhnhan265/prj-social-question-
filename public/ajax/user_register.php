<?php
require("../../config/config.php");

$userModule = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["Name"];
    $lastname = $_POST["Lastname"];
    $firstname = $_POST["Firstname"];
    $password = $_POST["Password"];
    $retype = $_POST["Cpassword"];

    $img = $_FILES["Avt"]["name"];
    $type = $_FILES["Avt"]["type"];
    $tmp_name = $_FILES["Avt"]["tmp_name"];
    $size = $_FILES["Avt"]["size"];

    // print_r($img);
    $img_ext = explode('.', $img);
    $img_correct_ext = strtolower(end($img_ext));
    $allow = array('jpg', 'png', 'jpeg');
    $path = "../avatar/" . $img;

    // $size = 10000;
    // $img = "img";

    if (in_array($img_correct_ext, $allow)) {
        if ($size < 500000) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date("Y/m/d");
            // $hour = date("h:i:sa");
            // $joinAt = $date . ' ' . $hour;
            if ($userModule->SignUp($username, $firstname, $lastname, $password,  $date , $img)) {
                move_uploaded_file($tmp_name, $path);
                // echo '<script>alert("Đăng ký thành công!"); window.location.href="./index.php";</script>';
                // echo 'You have successfully Registed!';
                echo 'Valid';
            } else {
                // echo ("Đăng ký thất bại");
                // echo 'Email Already Exits!';
                echo 'Invalid';
            }
        } else {
            // echo '<script>alert("Kích thước ảnh quá lớn! Vui lòng chọn kích thước < 50000KB"); window.location.href="./index.php";</script>';
            echo 'Invalid';
        }
        // } else {
        // echo 'Invalid format! Please choose jpg, png, jpeg!';
    }else{
        echo 'Invalid';
    }
}
