<?php 
// require("../config/config.php") ; 
class Vote extends Database { 
    
    //Phương thức thêm vote 
    public function insertVote($id_question,$username,$type ) { 
        try {
            $sql=parent::$connection->prepare("INSERT INTO `vote_question`(`id_question`, `username`, `type`) VALUES (?,?,?)");
            $sql->bind_param("iss",$id_question,$username,$type); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/insertVote: ".$th); 
            return false; 
        }
        return true; 
    }
    //Phương thức xóa vote 
    public function deleteVote($id_question,$username) { 
        try {
            $sql=parent::$connection->prepare("DELETE FROM `vote_question` WHERE id_question =? and username=?");
            $sql->bind_param("is",$id_question,$username); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/deleteVote: ".$th); 
            return false; 
        }
        return true;
    }
    //Phương thức sửa vote 
    public function editVote($id_question,$username,$type) { 
        try {
            $sql=parent::$connection->prepare("UPDATE `vote_question` SET `type`=? WHERE id_question=? and username=? ");
            $sql->bind_param("sis",$type,$id_question,$username); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/editAnswer: ".$th); 
            return false; 
        }
        return true; 
    }

    //Kiểm tra xem user đã vote chưa 
    public function isVoted($id_question,$username,$type){ 
        $sql=parent::$connection->prepare("select * from vote_question where id_question =? and username =?"); 
        $sql->bind_param("is",$id_question,$username); 
        $voteInfo=parent::select($sql); 
        if(count($voteInfo)>0) { 
            return $voteInfo[0]; 
        }
        return false; 
    }
    //Kiểm tra xem user đã vote chưa 
    public function isVotedAnswer($id_answer,$username,$type){ 
        $sql=parent::$connection->prepare("select * from vote_answer where id_answer =? and username =?"); 
        $sql->bind_param("is",$id_answer,$username); 
        $voteInfo=parent::select($sql); 
        if(count($voteInfo)>0) { 
            return $voteInfo[0]; 
        }
        return false; 
    }

    //Lấy tất cả câu hỏi đã vote bởi người dùng 
    public function getAllVotedQuestionsByUsername($username) { 
        $sql=parent::$connection->prepare("SELECT GROUP_CONCAT(id_question) AS voted,username,type FROM `vote_question` WHERE username=? GROUP BY(type);
        "); 
        $sql->bind_param("s",$username); 
        return parent::select($sql);  
    }

    
    //Lấy tất cả câu hỏi đã upvote bởi người dùng 
    public function getUpVotedQuestionsByUsername($username) { 
        $sql=parent::$connection->prepare("SELECT * FROM `vote_question` WHERE username=? and type='upvote'"); 
        $sql->bind_param("s",$username); 
        return parent::select($sql);  
    }


    //Lấy tất cả câu hỏi đã downvote bởi người dùng 
    public function getDownVotedQuestionsByUsername($username) { 
        $sql=parent::$connection->prepare("SELECT * FROM `vote_question` WHERE username=? and type='downvote'"); 
        $sql->bind_param("s",$username); 
        return parent::select($sql);  
    }

    //Thực hiện thêm vào bảng vote_question và tăng,giảm số lượng vote của bảng question

    public function Vote($id_question,$username,$type) { 
        try {
        $questionModule=new Question(); 

        //Nếu người dùng đã vote cho question rồi 
        $voteInfo=$this->isVoted($id_question,$username,$type); 
        if($voteInfo) { 
            //Nguời dùng ấn upvote hoặc downvote 1 lần nữa 
            if($voteInfo["type"]==$type) { 
                //xóa vote cũ 
                $this->deleteVote($id_question,$username); 
                //giảm số lượng vote của câu hỏi đó 
                $questionInfo=$questionModule->getQuestionByID($id_question); 
                $questionModule->minusVote($id_question,$type); 
            
            }
            //Người dùng chuyển qua nút upvote khi đã ấn downvote hoặc
            //chuyển từ downvote sang upvote 
            else { 
                //cập nhật lại bảng vote
                $this->editVote($id_question,$username,$type); 
                //nếu người dùng ấn upvote và trong DB lưu là downvote 
                if($type=="upvote" && $voteInfo["type"]=="downvote") { 
                     //giảm số lượng vote của câu hỏi đó 
                    $questionInfo=$questionModule->getQuestionByID($id_question); 
                    $questionModule->minusVote($id_question,$voteInfo["type"]); //giảm số lượng cái cũ 
                    $questionModule->addVote($id_question,$type); //giảm số lượng cái cũ 

                } 
                //nếu người dùng ấn downvote và trong DB lưu là upvote 
                if($type=="downvote" && $voteInfo["type"]=="upvote") { 
                       //giảm số lượng vote của câu hỏi đó 
                       $questionInfo=$questionModule->getQuestionByID($id_question); 
                       $questionModule->minusVote($id_question,$voteInfo["type"]); 
                       $questionModule->addVote($id_question,$type); //giảm số lượng cái cũ 

                } 
            }
        }
        //Nếu người dùng chưa ấn nút vote 
        else { 
            //thêm vào csdl 
            $this->insertVote($id_question,$username,$type);
            $questionInfo=$questionModule->getQuestionByID($id_question); 
            $questionModule->addVote($id_question,$type); 
        }
            //code...
        } catch (\Throwable $th) {
            echo($th); 
        }
        
    }

    //Phương thức chèn vào bảng vote_answer
    public function InsertVoteAnswer($id_answer,$username,$type) { 
        try {
            $sql=parent::$connection->prepare("insert into vote_answer (id_answer,username,type) values (?,?,?)"); 
            $sql->bind_param("iss",$id_answer,$username,$type); 
            $sql->execute(); 
            return true; 
        }
        catch (\Throwable $th) { 
            echo("có lỗi xảy ra trong Vote/InsertVoteAnswer".$th);    
            return false; 
        }
    }

     //Phương thức xóa vote 
     public function deleteVoteAnswer($id_answer,$username) { 
        try {
            $sql=parent::$connection->prepare("DELETE FROM `vote_answer` WHERE id_answer =? and username=?");
            $sql->bind_param("is",$id_answer,$username); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/deleteVoteAnswer: ".$th); 
            return false; 
        }
        return true;
    }

     //Phương thức xóa vote lien quan den cau tra loi
     public function deleteVotesOfAnswer($id_answer) { 
        try {
            $sql=parent::$connection->prepare("DELETE FROM `vote_answer` WHERE id_answer =?");
            $sql->bind_param("i",$id_answer); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/deleteVotesOfAnswer: ".$th); 
            return false; 
        }
        return true;
    }


    //Phương thức sửa vote 
    public function editVoteAnswer($id_answer,$username,$type) { 
        try {
            $sql=parent::$connection->prepare("UPDATE `vote_answer` SET `type`=? WHERE id_answer=? and username=? ");
            $sql->bind_param("sis",$type,$id_answer,$username); 
            $sql->execute(); 
        } catch (Throwable $th) {
            echo("Có lỗi xảy ra trong Vote/editAnswer: ".$th); 
            return false; 
        }
        return true; 
    }


    //Phương thức cập nhật các bảng liên quan cho việc vote câu trả lời 
    public function VoteAnswer($id_answer,$username,$type) { 
        try {
        $answerModule=new Answer(); 

        //Nếu người dùng đã vote cho answer rồi 
        $voteInfo=$this->isVotedAnswer($id_answer,$username,$type); 
        if($voteInfo) { 
            //Nguời dùng ấn upvote hoặc downvote 1 lần nữa 
            if($voteInfo["type"]==$type) { 
                //xóa vote cũ 
                $this->deleteVoteAnswer($id_answer,$username); 
                //giảm số lượng vote của câu hỏi đó 
                $answerModule->minusVote($id_answer,$type); 
            
            }
            //Người dùng chuyển qua nút upvote khi đã ấn downvote hoặc
            //chuyển từ downvote sang upvote 
            else { 
                //cập nhật lại bảng vote
                $this->editVoteAnswer($id_answer,$username,$type); 
                //nếu người dùng ấn upvote và trong DB lưu là downvote 
                if($type=="upvote" && $voteInfo["type"]=="downvote") { 
                     //giảm số lượng vote của câu hỏi đó 
                    $answerInfo=$answerModule->getAnswerByID($id_answer)[0]; 
                    $answerModule->minusVote($id_answer,$voteInfo["type"]); //giảm số lượng cái cũ 
                    $answerModule->addVote($id_answer,$type); //giảm số lượng cái cũ 

                } 
                //nếu người dùng ấn downvote và trong DB lưu là upvote 
                if($type=="downvote" && $voteInfo["type"]=="upvote") { 
                       //giảm số lượng vote của câu hỏi đó 
                       $answerInfo=$answerModule->getAnswerByID($id_answer)[0]; 
                       $answerModule->minusVote($id_answer,$voteInfo["type"]); 
                       $answerModule->addVote($id_answer,$type); //giảm số lượng cái cũ 

                } 
            }
        }
        //Nếu người dùng chưa ấn nút vote 
        else { 
            //thêm vào csdl 
            $this->InsertVoteAnswer($id_answer,$username,$type);
            $answerInfo=$answerModule->getAnswerByID($id_answer); 
            $answerModule->addVote($id_answer,$type); 
        }
            //code...
        } catch (\Throwable $th) {
            echo($th); 
        }
        
    }
}