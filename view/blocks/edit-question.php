<?php
require("../../config/config.php");

$userModule = new User();
$questionModule = new Question();

if (isset($_GET['id']) && $_GET['id'] != "") {
	$id = $_GET['id'];
	// $content = $_POST["content"];
	// $type = $_POST["type"];
	// $author = $_POST["author"];

	// // Kiểm tra xem các giá trị có rỗng hay không
	// if (empty($content) || empty($type) || empty($author)) {
	// 	set_message(display_error("Vui lòng điền đầy đủ thông tin!"));
	// 	header("location: ../../admin/question.php");
	// 	exit();
	// } else {
	// 	$update_question = $questionModule->updateQuestionById($id, $content, $type, $author);
	// 	if (!empty($update_question)) {
	// 		set_message(display_success("Cập nhật thành công!"));
	// 		header("location: ../../admin/question.php");
	// 		exit();
	// 	} else {
	// 		set_message(display_error("Lỗi cập nhật"));
	// 		header("location: ../../admin/question.php");
	// 		exit();
	// 	}
	// }

	$question = $questionModule->getQuestionByID($id);
}

?>

<div class="container">
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
		<form action="./update_question.php?id=<?php echo $question['id']; ?>" method="POST">
			<h3 class="text-center">Edit Question Information</h3>
			<?php
			display_message();
			?>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Content:</label>
						<input type="text" name="content" class="form-control" value="<?php echo $question['content'] ?>" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Type: </label>
						<input type="text" name="type" class="form-control" value="<?php echo $question['type'] ?>" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Author:</label>
						<input type="text" name="author" class="form-control" value="<?php echo $question['author'] ?>" required>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Mobile Number:</label>
						<input type="tel" name="phone" class="form-control" value="" required pattern=[0-9]{10}>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Date Of Birth:</label>
						<input type="date" name="birthday" class="form-control" value="" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Gender:</label>
						<select name="gender" class="form-control" value="" required>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Nationality:</label>
						<input type="text" name="nationality" class="form-control" value="" required>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="profile_details_text">Monthly Income:</label>
						<input type="text" name="monthly_income" class="form-control" value="" required>
					</div>
				</div>
			</div> -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>