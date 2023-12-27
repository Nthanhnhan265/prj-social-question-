<?php
require("../config/config.php");

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    unset($_SESSION["avt"]);
    // echo '<script>alert("Đăng xuất thành công!"); window.location.href="./index.php";</script>';
    header("location: index.php");
} else {
    echo '<script>alert("Chưa đăng nhập tài khoản!"); window.location.href="./index.php";</script>';
}
