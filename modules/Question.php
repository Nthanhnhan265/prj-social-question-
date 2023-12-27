<?php 
class Question extends Database { 

    //PHương thức lấy câu hỏi đã tạo bởi người dùng 
    public function getQuestionsByUser($username) { 
        $sql=parent::$connection->prepare("select * from questions where author=?");
        $sql->bind_param("s",$username);  
        return parent::select($sql); 
    }

    //Phương thức lấy câu hỏi trong trang  
    public function getQuestionsInPage($startPage, $numOfPage) { 
        $sql=parent::$connection->prepare("select * from questions limit $startPage,$numOfPage");
        return parent::select($sql); 
    }

    //Phương thức hiển thị tất cả câu hỏi 
    public function getAllQuestions() { 
        $sql=parent::$connection->prepare("select * from questions order by id desc"); 
        return parent::select($sql); 
    }

    
    //Phương thức trả về câu hỏi có chứa hashtag 
    public function getAllQuestionByTag($tagName){ 
        $sql =parent::$connection->prepare("SELECT questions.* FROM `hashtag_question`,questions,hashtags where hashtag_question.id_hashtag=hashtags.id_hashtag and questions.id=hashtag_question.id_question and hashtags.name=?");
        $sql->bind_param('s',$tagName);
        return parent::select($sql);  
    }

    //Phương thức chèn câu hỏi 
    public function insertQuestion($content,$type,$created_at,$edit_at,$author) { 
        try {
            $sql=parent::$connection->prepare("insert into questions (content,type,created_at,edited_at,author) values (?,?,?,?,?) ");
            $sql->bind_param("sssss",$content,$type,$created_at,$edit_at,$author); 
            $sql->execute(); 
            return parent::$connection->insert_id; 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/insertQuestion: ".$th); 
            return false; 
        }
    }
    //phương thức trả về câu hỏi có lượt vote nhiều nhất 
    public function getTopQuestions() { 
        $sql=parent::$connection->prepare("select * from questions ORDER BY (questions.upvote) DESC LIMIT 3;
        "); 
        return parent::select($sql); 
    }

    //Phương thức lấy câu hỏi gần đây 
    public function getQuestionsRecentView($arrIDs) { 
        $questionMark='('.str_repeat('?,',count($arrIDs)-1).'?)'; 
        $types=str_repeat('i',count($arrIDs)); 
        $sql=parent::$connection->prepare("SELECT * FROM questions where id in $questionMark");
        $sql->bind_param($types,...$arrIDs);
        return parent::select($sql);
    }

    //Phương thức xóa câu hỏi 
    public function deleteQuesiton($id) { 
        try {
            $sql=parent::$connection->prepare("delete from questions where id=?");
            $sql->bind_param("i",$id); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/deleteQuestion: ".$th); 
            return false; 
        }
        return true;
    }
    //Phương thức sửa câu hỏi 
    public function editQuestion($content,$edited_at,$id) { 
        try {
            $sql=parent::$connection->prepare("update questions set content=?,edited_at=? where id=?");
            $sql->bind_param("ssi",$content,$edited_at,$id); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Question/insertQuestion: ".$th); 
            return false; 
        }
        return true; 
    }

    //Lấy câu hỏi qua ID
    public function getQuestionByID($id){ 
        $sql=parent::$connection->prepare("select * from questions where id=?"); 
        $sql->bind_param("i",$id); 
        $questionInfo=parent::select($sql); 
        if(count($questionInfo)>0) {
            return $questionInfo[0]; 
        }
        return false; 
    }

    


    //Giảm số lượng upvote của câu hỏi 
    public function minusVote($id,$type) { 
        try { 
            $sql; 
            if($type=="upvote") { 
                $sql=parent::$connection->prepare("Update questions set upvote=upvote-1 where id=?"); 
            }else { 
                $sql=parent::$connection->prepare("Update questions set downvote=downvote-1 where id=?"); 
            }
            $sql->bind_param('i',$id);
            $sql->execute(); 
            return true;  
        }catch (Throwable $th){ 
            echo("Có lỗi xảy ra trong Question/minusUpVote: ".$th); 
            return false; 
        }
    }    

    //Tăng số lượng câu hỏi 
    public function addVote($id,$type) { 
        try { 
            $sql; 
            if($type=="upvote") { 
                $sql=parent::$connection->prepare("Update questions set upvote=upvote+1 where id=?"); 
            }else { 
                $sql=parent::$connection->prepare("Update questions set downvote=downvote+1 where id=?"); 
            }
            $sql->bind_param('i',$id);
            $sql->execute(); 
            return true;  
        }catch (Throwable $th){ 
            echo("Có lỗi xảy ra trong Question/addVote: ".$th); 
            return false; 
        }
    }

}