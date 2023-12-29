<?php
require("../../config/config.php");

$userModule = new User();
$questionModule = new Question();

if (isset($_GET['username']) && $_GET['username'] != "") {
	$username = $_GET['username'];
	$firstname = $_POST['first_name'];
	$lastname = $_POST["last_name"];

	$img = $_FILES['img']['name'];
	$type = $_FILES['img']['type'];
	$tmp_name = $_FILES['img']['tmp_name'];
	$size = $_FILES['img']['size'];

	$img_ext = explode('.', $img);
	$img_correct_ext = strtolower(end($img_ext));
	$allow = array('jpg', 'png', 'jpeg');
	$path = "../../public/avatar/" . $img;

	// Kiểm tra xem các giá trị có rỗng hay không
	if (empty($firstname) || empty($lastname)) {
		set_message(display_error("Vui lòng điền đầy đủ thông tin!"));
		header("location: ../../admin/admin.php");
		exit();
	} else {
		if (empty($img)) {
			$update_user = $userModule->updateUserByUsernameExistAvatar($username, $firstname, $lastname);
			if (!empty($update_user)) {
				move_uploaded_file($tmp_name, $path);
				set_message(display_success(" Cập nhật user thành công! "));
				header("location: ../../admin/admin.php");
				exit();
			} else {
				set_message(display_error(" Cập nhật thất bại! "));
				header("location: ../../admin/admin.php");
				exit();
			}
		} else {
			if ($size < 500000) {
				if (in_array($img_correct_ext, $allow)) {
					$update_user = $userModule->updateUserByUsername($username, $firstname, $lastname, $img);
					if (!empty($update_user)) {
						move_uploaded_file($tmp_name, $path);
						set_message(display_success(" Cập nhật user thành công! "));
						header("location: ../../admin/admin.php");
						exit();
					} else {
						set_message(display_error(" Cập nhật thất bại! "));
						header("location: ../../admin/admin.php");
						exit();
					}
				} else {
					set_message(display_error("Vui lòng chọn định dạng JPG, PNG, JPEG!"));
					header("location: ../../admin/admin.php");
					exit();
				}
			} else {
				set_message(display_error("Kích thước hình ảnh quá lớn, vui lòng chọn nhỏ hơn 500KB!"));
				header("location: ../../admin/admin.php");
				exit();
			}
		}
	}
} else {
	set_message(display_success(" Vui lòng nhập đầy đủ thông tin! "));
	header("location: ../../admin/admin.php");
}
