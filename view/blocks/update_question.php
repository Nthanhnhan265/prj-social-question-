<?php
require("../../config/config.php");

$userModule = new User();
$questionModule = new Question();

if (isset($_GET['id']) && $_GET['id'] != "") {
	$id = $_GET['id'];
	$content = $_POST["content"];
	$type = $_POST["type"];
	$author = $_POST["author"];

	// Kiểm tra xem các giá trị có rỗng hay không
	if (empty($content) || empty($type) || empty($author)) {
		set_message(display_error("Vui lòng điền đầy đủ thông tin!"));
		header("location: ../../admin/question.php");
		exit();
	} else {
		$update_question = $questionModule->updateQuestionById($id, $content, $type, $author);
		if (!empty($update_question)) {
			set_message(display_success("Cập nhật thành công!"));
			header("location: ../../admin/question.php");
			exit();
		} else {
			set_message(display_error("Lỗi cập nhật"));
			header("location: ../../admin/question.php");
			exit();
		}
	}
	
}

?>