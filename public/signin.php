<?php
require("../config/config.php");
// $username=""; 
// $password=""; 
$userModule = new User();


if (empty($_POST["username"]) || empty($_POST["password"])) {
  set_message(display_error("Please fill full in the blanks!"));
  header("location: ./index.php");
} else {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $user = $userModule->SignIn($username);
  if (!empty($user)) {
    if (password_verify($password, $user["password"])) {
      setcookie("username", $username, time() + 86400 * 30);
      setcookie("password", $user["password"], time() + 86400 * 30);
      $_SESSION["username"] = $username;
      $_SESSION["avt"] = $userModule->getAvatarByUsername($username);
      // echo '<script>alert("Đăng nhập thành công!"); window.location.href="./index.php";</script>';
    } else {
      // header("location: ./index.php");
      // echo '<script>alert("Mật khẩu không đúng! Vui lòng kiểm tra lại"); window.location.href="./index.php";</script>';
      set_message(display_error("Please check your password again!"));
    }
  } else {
    // header("location: ./index.php");
    // echo '<script>alert("Vui lòng kiểm tra lại tên tài khoản"); window.location.href="./index.php";</script>';
    set_message(display_error("Please check your account name again"));
  }
  header("location: ./index.php");
}
?>