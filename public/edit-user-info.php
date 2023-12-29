<?php
require("../config/config.php");
$type = "question";
$author = "";
$content = "";
$created_at = date("Y-m-d");
$imageModule = new Images();
$questionModule = new Question();
$tagModule = new HashTag();
$acceptImagesExtension = ["image/png", "image/jpeg"];
$id_question = '';
$strHashtag = "";
$userModule = new User();
$avatar=''; 
//Nhận thông tin 
if (!empty($_POST["firstname"])) {
    $firstname = $_POST["firstname"];
    echo ($firstname);
}

if (!empty($_POST["lastname"])) {
    $lastname = $_POST["lastname"];
    echo ($lastname);
}


if (!empty($_POST["description"])) {
    $description = $_POST["description"];
    echo ("checked content");
    echo ($description);
}
if(!empty($_POST['old-avatar'])) { 
    $avatar=$_POST['old-avatar'];
}

//hỉnh ảnh 
var_dump($_FILES); 

date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('Y-m-d H:m');
//kiểm tra và update
if (!empty($firstname) && !empty($lastname) && !empty($description)) {

    //
    if (!empty($_FILES['avatar']['name'][0])) {
        if (in_array($_FILES['avatar']['type'], $acceptImagesExtension)) {
            //thiết lập nơi lưu cho hình ảnh, hình ảnh trong tmp sẽ được di     chuyển và đổi tên như thiết lập
            $targetPath = BASE_PATH . '/public/avatar/' . uniqid('img_') . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            //chuyển file được lưu trong folder tạm và đổi tên như thiết lập 
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
                echo "File uploaded successfully!";
                $avatar= pathinfo($targetPath, PATHINFO_FILENAME) . '.' . pathinfo($targetPath, PATHINFO_EXTENSION);
                
            } else {
                echo "Error uploading file.";
            }
    
        } else {
            echo ("wrong file extension.");
        }
    }
    
    $flag = $userModule->editInformation($firstname, $lastname, $description,$avatar, $_SESSION['username']);




    header("location: http://localhost/prj-social-question-/public/index.php");
    // echo($author.$content); 
} else {
    echo ("<h1 style='text-aligns:center'>Thêm thất bại</h1>");
}
