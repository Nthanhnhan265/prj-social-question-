<?php
require("../../config/config.php");
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

if (!empty($_POST["hashtags"])) {
    $strHashtag = $_POST["hashtags"];
}



if (!empty($_POST["content"])) {
    $content = $_POST["content"];
    echo ("checked content");
    
}

if (!empty($_POST['id'])) {
    $id_question = $_POST['id'];
    echo ("checked content");

}


date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('Y-m-d H:m');

if (!empty($content)) {
    //    public function editQuestion($content,$edited_at,$id) { 
   $temp = $questionModule->editQuestion($content, date("Y-m-d H:m"), $id_question);
    // $temp=false; 


    if ($temp != false && !empty($strHashtag)) {
        //Xóa toàn bộ hashtag được gắn vào question và chèn lại 
        $tagModule->deleteAllHashtagsByIDQuestion($id_question);
        $tagModule->insertHashtagQuestion($id_question, explode(',', $strHashtag));
        //Kiểm tra hình ảnh được up lên  
    }
    //Trường hợp người dùng gửi lên hình ảnh thì xóa cũ và chèn lại 
    if ($temp != false && !empty($_FILES['images']['name'][0])) {
        $savedImaged = [];
        //xóa trên DB 
        $flag = $imageModule->deleteImagesByID_question($id_question);

        //chưa xóa trong thư mục 

        //Nếu xóa thành công trong DB thì thêm mới 
        if ($flag) {
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                if (in_array($_FILES['images']['type'][$i], $acceptImagesExtension)) {
                    //thiết lập nơi lưu cho hình ảnh, hình ảnh trong tmp sẽ được di chuyển và đổi tên như thiết lập
                    $targetPath = BASE_PATH . '/public/images/' . uniqid('img_') . '.' . pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                    //chuyển file được lưu trong folder tạm và đổi tên như thiết lập 
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetPath)) {
                        echo "File uploaded successfully!";
                        $savedImaged[] = pathinfo($targetPath, PATHINFO_FILENAME) . '.' . pathinfo($targetPath, PATHINFO_EXTENSION);
                    } else {
                        echo "Error uploading file.";
                    }

                } else {
                    echo ("wrong file extension.");
                }
            }

            $imageModule->inserstImages($savedImaged, $id_question, 'question');
        }





    }
    header("location: http://localhost/prj-social-question-/public/index.php");
    // echo($author.$content); 
} else {
    echo ("<h1 style='text-aligns:center'>Thêm thất bại</h1>");
}
