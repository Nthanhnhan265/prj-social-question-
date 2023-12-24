<?php 
class Answer extends Database { 

    //Phuong thuc tra ve cau hoi qua id_answer 
    public function getAnswerByID($id_answer) { 
        $sql=parent::$connection->prepare("select * from answers where id_answer=?");
        $sql->bind_param('i',$id_answer);
        return parent::select($sql);   
    }
    //Phương thức hiển thị tất cả trả lời của một câu hỏi
    public function getAllAnswersByQuestion($username, $id) { 
        $sql=parent::$connection->prepare("
        SELECT questions.id as id_question, answers.*,users.firstname, users.lastname,user_voted_answer.type
        from questions
        INNER JOIN answers 
        ON questions.id=answers.id_question 
        INNER JOIN users 
        ON answers.author=users.username
        LEFT JOIN (
            select * from vote_answer where username='nhan' 
        ) as user_voted_answer
        ON user_voted_answer.id_answer=answers.id_answer 
        WHERE answers.id_question=23;        
        "); 

       // $sql->bind_param("si",$username,$id); 
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
  //Giảm số lượng upvote của câu trả lời  
  public function minusVote($id_answer,$type) { 
    try { 
        $sql; 
        if($type=="upvote") { 
            $sql=parent::$connection->prepare("Update answers set upvote=upvote-1 where id_answer=?"); 
        }else { 
            $sql=parent::$connection->prepare("Update answers set downvote=downvote-1 where id_answer=?"); 
        }
        $sql->bind_param('i',$id_answer);
        $sql->execute(); 
        return true;  
    }catch (Throwable $th){ 
        echo("Có lỗi xảy ra trong Answer/minusUpVote: ".$th); 
        return false; 
    }
}    

//Tăng số lượng câu hỏi 
public function addVote($id_answer,$type) { 
    try { 
        $sql; 
        if($type=="upvote") { 
            $sql=parent::$connection->prepare("Update answers set upvote=upvote+1 where id_answer=?"); 
        }else { 
            $sql=parent::$connection->prepare("Update answers set downvote=downvote+1 where id_answer=?"); 
        }
        $sql->bind_param('i',$id_answer);
        $sql->execute(); 
        return true;  
    }catch (Throwable $th){ 
        echo("Có lỗi xảy ra trong Answer/addVote: ".$th); 
        return false; 
    }
}
    
    


}