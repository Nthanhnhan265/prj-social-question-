<?php
require("../../config/config.php");
$userModule = new User();

if ($_SESSION['role'] != 'admin') {
    header("location: ../../public/index.php");
}

if (isset($_GET['username'])) {
    $username = $_GET["username"];
    $user = $userModule->deleteUserByUsername($username);

    if ($user) {
        set_message(display_success("Xóa thành công!"));
        header("location: ../../admin/admin.php");
        exit(); // Thêm exit để dừng ngay sau khi redirect
    } else {
        set_message(display_error("Lỗi thao tác xóa"));
        header("location: ../../admin/admin.php");
        exit(); 
    }
}

?>

