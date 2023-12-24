<?php 
class Bookmark extends Database {  

    //Phương thức lấy tất cả bookmark qua username 
     public function getAllBookmarkByUsername($username) { 
        $sql=parent::$connection->prepare("SELECT * FROM Bookmarks WHERE marked_by=? "); 
        $sql->bind_param("s",$username); 
        return parent::select($sql); 
     }

     //Phuong thuc lay tat ca bookmark da danh dau cua user 
     public function getAllMarkedQuestions($username ) { 
        $sql=parent::$connection->prepare("SELECT questions.*,bookmarks.marked_by FROM `bookmarks` INNER JOIN questions
        on bookmarks.question_id=questions.id
        WHERE marked_by=?"); 
        $sql->bind_param("s",$username); 
        return parent::select($sql); 
     }

     //Phương thức lấy tất cả các câu hỏi đã đánh dấu 
     public function getAllQuestionsMarked($username) { 
        $sql=parent::$connection->prepare("SELECT GROUP_CONCAT(question_id) as questions,marked_by FROM Bookmarks WHERE marked_by=?"); 
        $sql->bind_param("s",$username); 
        $data= parent::select($sql); 
        if(!empty($data)) { 
            return $data[0]; 
        }
        return false; 
     }

     //Kiểm tra xem đã đánh dấu bookmark hay chưa 
     public function isMarked($username, $id_question) { 
        $sql=parent::$connection->prepare("SELECT * FROM Bookmarks WHERE marked_by=? and question_id=? "); 
        $sql->bind_param("si",$username,$id_question); 
        $bookmarkInfo=parent::select($sql); 
        if(!empty($bookmarkInfo)){ 
            return $bookmarkInfo[0]; 
        }
        return false; 
     } 

     //Phương thức thêm bookmark qua username và id_question 
     public function insertBookmark($username,$id_question) { 
        try {
            $dateString=date('Y-m-d'); 
            $sql=parent::$connection->prepare("INSERT INTO `bookmarks`(`question_id`, `marked_by`, `created_at`) VALUES (?,?,?)"); 
            $sql->bind_param("iss",$id_question,$username,$dateString);
            $sql->execute();
            return true; 

        } catch (\Throwable $th) {
            echo("có lỗi xảy ra trong bookmark/insertBookmark: ".$th); 
            return false; 
        }
     }
     //Phuong thuc xoa bookmark qua username
     public function delBookmark($username,$id_question) { 
        try {
            $sql=parent::$connection->prepare("DELETE FROM `bookmarks` WHERE marked_by =? and question_id=?"); 
            $sql->bind_param("si",$username,$id_question);
            $sql->execute();
            return true; 

        } catch (\Throwable $th) {
            echo("có lỗi xảy ra trong bookmark/delBookmark: ".$th); 
            return false; 
        }
     }

     //Thực hiện Đánh dấu bookmark 
     public function implementBookmark($username,$id_question) { 
        try {
            $bookmarkInfo=$this->isMarked($username,$id_question);
            //Kiểm tra xem người dùng đã đánh dấu hay chưa 
            if($bookmarkInfo!=false)//dữ liệu đã tồn tại
            {   //xóa nếu đã tồn tại 
                $this->delBookmark($username,$id_question); 
            }else //dữ liệu chưa tồn tại  
            {   //insert vào nếu chưa tồn tại 
                $this->insertBookmark($username,$id_question);
            }
            return true; 
        } catch (\Throwable $th) {
            $_SESSION["test"]=$th; 
            echo("Có lỗi xảy ra trong Bookmark/implementBookmark: ".$th); 
            return false; 
        }
     }
}