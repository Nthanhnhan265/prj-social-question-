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

$strHashtag = "";

if (!empty($_POST["hashtags"])) {
    $strHashtag = $_POST["hashtags"];
}

if (!empty($_POST["author"])) {
    $author = $_POST["author"];
    echo ("checked");
}

if (!empty($_POST["content"])) {
    $content = $_POST["content"];
    echo ("checked");

}




if (!empty($author) && !empty($content)) {
    $temp = $questionModule->insertQuestion($content, $type, $created_at, $created_at, $author);
    var_dump($_FILES); 
    if ($temp != false && !empty($strHashtag)) {
        var_dump(explode(',', $strHashtag));
        $tagModule->insertHashtagQuestion($temp, explode(',', $strHashtag));
        //Kiểm tra hình ảnh được up lên  
        $savedImaged = [];  
        }
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            if (in_array($_FILES['images']['type'][$i], $acceptImagesExtension)) {
                //thiết lập nơi lưu cho hình ảnh, hình ảnh trong tmp sẽ được di chuyển và đổi tên như thiết lập
                $targetPath = BASE_PATH . '/public/images/' . uniqid('img_') . '.' . pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                //chuyển file được lưu trong folder tạm và đổi tên như thiết lập 
                if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetPath)) {
                    echo "File uploaded successfully!";
                    $savedImaged[] = pathinfo($targetPath, PATHINFO_FILENAME).'.'.pathinfo($targetPath, PATHINFO_EXTENSION);
                } else {
                    echo "Error uploading file.";
                }

            } else {
                echo ("wrong file extension.");
            }

            
            
            
            
            
            
            
            
        }
        $imageModule->inserstImages($savedImaged, $temp, 'question');
        header("location: http://localhost/prj-social-question/public/index.php");
    // echo($author.$content); 
} else {
    echo ("<h1 style='text-aligns:center'>Thêm thất bại</h1>");
}
