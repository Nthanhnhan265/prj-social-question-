<?php 
class Answer extends Database { 

    //Phương thức hiển thị tất cả trả lời của một câu hỏi
    public function getAllAnswersByQuestion($id) { 
        $sql=parent::$connection->prepare("select answers.*,users.firstname,users.lastname from users,answers where users.username=answers.author and id_question=?"); 
        $sql->bind_param("i",$id); 
        return parent::select($sql); 
    }
    //Phương thức thêm câu trả lời $content,$created_at,$edited_at,$status,$id_quesion
    public function insertAnswer($content,$author,$created_at,$edited_at,$status,$id_quesion) { 
        try {
            $sql=parent::$connection->prepare("INSERT INTO `answers`(`content`,`author`, `created_at`, `edited_at`, `status`, `id_question`) VALUES (?,?,?,?,?,?)"); 
            $sql->bind_param("sssssi",$content,$author,$created_at,$edited_at,$status,$id_quesion); 
            $sql->execute(); 
            return parent::$connection->insert_id; 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/insertAnswer: ".$th); 
            return false; 
        }
    }
    //Phương thức xóa câu trả lời 
    public function deleteAnswer($id) { 
        try {
            $sql=parent::$connection->prepare("delete from answers where id_answer=?");
            $sql->bind_param("i",$id); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/deleteAnswer: ".$th); 
            return false; 
        }
        return true;
    }
    //Phương thức sửa câu trả lời 
    public function editAnswer($content,$edited_at,$status,$id_answer) { 
        try {
            $sql=parent::$connection->prepare("UPDATE `answers` SET `content`=?,`edited_at`=?,`status`=? where `id_question`=?");
            $sql->bind_param("sssi",$content,$edited_at,$status,$id_answer); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/editAnswer: ".$th); 
            return false; 
        }
        return true; 
    }

}