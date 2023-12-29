<?php
require("../../config/config.php");
$userModule = new User();
$questionModule = new Question();

if ($_SESSION['role'] != 'admin') {
    header("location: ../../public/index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET["id"]; 
    $question = $questionModule->deleteQuestionById($id);
    if ($question) {
        set_message(display_success("Xóa thành công!"));
        header("location: ../../admin/question.php");
        exit(); // Thêm exit để dừng ngay sau khi redirect
    } else {
        set_message(display_error("Lỗi thao tác xóa"));
        header("location: ../../admin/question.php");
        exit(); 
    }
}

?>

