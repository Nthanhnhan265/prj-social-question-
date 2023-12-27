<?php
require("../config/config.php");
// $username="";
// $password=""; 
// $description="";
// $firstname=""; 
// $lastname=""; 
// $avatar=""; 
$userModule = new User();

// var_dump($_POST);

// kiem tra co rong khong

$username = $_POST["username"];
$lastname = $_POST["lastname"];
$firstname = $_POST["firstname"];
$password = $_POST["password"];
$retype = $_POST["retype"];

$img = $_FILES['avt']['name'];
$type = $_FILES['avt']['type'];
$tmp_name = $_FILES['avt']['tmp_name'];
$size = $_FILES['avt']['size'];

$img_ext = explode('.', $img);
$img_correct_ext = strtolower(end($img_ext));
$allow = array('jpg', 'png', 'jpeg');
$path = "avatar/" . $img;

// var_dump($_POST);

// var_dump($img);

if (empty($username) || empty($lastname) || empty($firstname) || empty($password) || empty($retype) || empty($img)) {
    echo '<script>alert("Vui lòng nhập đủ thông tin!"); window.location.href="./index.php";</script>';
} else {
    if ($password == $retype) {
        if (in_array($img_correct_ext, $allow)) {
            if ($size < 500000) {
                     $joinAt=date("Y/m/d"); 


                    // public function SignUp($username, $firstName, $lastName, $password, $joinAt, $avatar)
                    //$userModule->SignUp('6','3','4','5',$joinAt,''); 
                if ($userModule->SignUp($username, $firstname, $lastname, $password, $joinAt, $img)) {
                    move_uploaded_file($tmp_name, $path);
                    echo '<script>alert("Đăng ký thành công!"); window.location.href="./index.php";</script>';
                } else {
                    echo ("Đăng ký thất bại");
                }
            } else {
                echo '<script>alert("Kích thước ảnh quá lớn! Vui lòng chọn kích thước < 50000KB"); window.location.href="./index.php";</script>';
            }
        } else {
            echo '<script>alert("Định dạng không hợp lệ! Vui lòng chọn jpg, png, jpeg!"); window.location.href="./index.php";</script>';
        }
    } else {
        echo '<script>alert("Mật khẩu không trùng khớp!"); window.location.href="./index.php";</script>';
    }
}




// if ($password == $retype) {
//     //nhớ ràng buộc trước khi thêm vào 
//     if ($userModule->SignUp($username, $firstname, $lastname, $password, $joinAt, $avatar)) {
//     echo '<script>alert("Đăng ký thành công!"); window.location.href="./index.php";</script>';
//     } else {
//         echo ("Đăng ký thất bại");
//     }
// } else {
//     echo 'Mat khau khong trung khop';
// }else {
// echo 'Vui long nhap day du du lieu';
