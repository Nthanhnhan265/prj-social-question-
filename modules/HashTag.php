<?php 
class HashTag extends Database { 

    //search 
    public function search ($string) {
        $string="%$string%";  
        $sql=parent::$connection->prepare("select * from hashtags where name like ? ");
        $sql->bind_param("s",$string);  
        return parent::select($sql);  

    }
    
    // PHương thức lấy tất cả tags trong trang
    public function getTagsInPage($startPage,$perPage) { 
        $sql=parent::$connection->prepare("SELECT * FROM hashtags limit $startPage,$perPage");
        return parent::select($sql); 
    }

    // PHương thức lấy tất cả tags 
    public function getAllTags() { 
        $sql=parent::$connection->prepare("SELECT * FROM hashtags");
        return parent::select($sql); 
    }

    //Phương thức lấy tất cả Tags của tất cả câu hỏi 
    public function getAllTagsAndQuestions() { 
        $sql=parent::$connection->prepare("SELECT GROUP_CONCAT(hashtags.name) as tags,hashtag_question.id_question
        FROM hashtag_question INNER JOIN hashtags
        ON hashtag_question.id_hashtag=hashtags.id_hashtag
        GROUP BY (hashtag_question.id_question)"); 
        return parent::select($sql); 
    }


    //Phương thức lấy tất cả tags được gán nhiều nhất trong 24h qua 
    public function getAllTagsIn24Hours () { 
        $sql=parent::$connection->prepare("SELECT hashtags.*,hashtag_question.created_at, count(hashtag_question.id_hashtag) as count FROM `hashtag_question`,`hashtags` WHERE hashtag_question.created_at >date_sub(now(),INTERVAL 30 Day) and hashtag_question.id_hashtag=hashtags.id_hashtag GROUP BY hashtag_question.id_hashtag ORDER BY count desc;"); 
        return parent::select($sql); 
    }

    //Phương thức lấy tất cả tags của câu hỏi 
    public function getAllTagsOfQuestion($id_question) { 
        $sql=parent::$connection->prepare("SELECT * FROM "); 
    }
    public function getExistTags($arrHashtags) { 
        $questionMarks=str_repeat("name=? OR ",count($arrHashtags)-1)."name=?"; 
        $types=str_repeat("s",count($arrHashtags)); 
        $sql=parent::$connection->prepare("SELECT GROUP_CONCAT(id_hashtag) as ExistID, GROUP_CONCAT(name) as ExistName FROM `hashtags` WHERE $questionMarks"); 
        $sql->bind_param($types,...$arrHashtags); 
        return parent::select($sql)[0];
    }
    //phương thức thêm vào bảng Hashtags 
    //Ex: ["a","b","c"]
    public function insertHashtags($arrHashtags) { 
        try {
            $QuesMarks=str_repeat("(?),",count($arrHashtags)-1)."(?)"; 
            $types=str_repeat("s",count($arrHashtags)); 
            $sql=parent::$connection->prepare("INSERT INTO `hashtags`(`name`) VALUES ".$QuesMarks); 
            $sql->bind_param($types,...$arrHashtags); 
            $sql->execute(); 
        } catch (\Throwable $th) {
            echo("Có lỗi xảy ra trong Hashtag/insertHashtags: ".$th); 
        }
    }

    //Phương thức xóa tất cả hashtag của 1 question 
    public function deleteAllHashtagsByIDQuestion($id_question) {
        try {
            $sql=parent::$connection->prepare("DELETE FROM hashtag_question WHERE id_question=?"); 
            $sql->bind_param("i",$id_question); 
            $sql->execute();
            return true;  
        } catch (\Throwable $th) {
            echo("Có lỗi xảy ra trong Hashtag/deleteAllHashtagsByIDQuestion: ".$th); 
            return false; 
        }
    }

    //Phương thức thêm vào bảng hashtag_question:
    //Ex 
    public function insertHashtagQuestion($id_question,$arrHashtags){ 
        try {
        //lấy các tag name đã tồn tại  
        $existTags=$this->getExistTags($arrHashtags); 
        $existNames=""; 
        $arrNewTags=array(); 
        if(!empty($existTags["ExistName"])) { 
            $existNames=explode(',',$existTags["ExistName"]); 
        }
        //Duyệt vòng for và them vào mảng arrNewTags 
        foreach($arrHashtags as $tag) { 
            
            //kiểm tra tag đã tồn tại hay chưa 
            if( empty($existNames) || !in_array($tag,$existNames)) { 
                //chưa tồn tại thì thêm vào mảng  
                array_push($arrNewTags,$tag); 
            }
        }
        
        //nếu không tồn tại thì thêm vào bảng hashtags 
        if(!empty($arrNewTags)){ 
            $this->insertHashtags($arrNewTags); 
        }

        //lấy tất cả ID đã tồn tại 
        $existTags=$this->getExistTags($arrHashtags); 
        $existIDs=$existTags["ExistID"];
        $arrIDs=explode(',',$existIDs);  
        $arrResult=[]; 

        //duyệt vòng for để chèn xen kẽ 
        foreach ($arrIDs as $id_tag) {
            array_push($arrResult,(int)$id_tag); 
            array_push($arrResult,(int)$id_question); 
        }
        var_dump($arrResult); 
        //chèn vào bảng hashtag_question: với những IDs của tags
        $questionMarks=str_repeat("(?,?),",count($arrResult)/2-1)."(?,?)";
        $types=str_repeat("i",count($arrResult));  
        echo($questionMarks);
        $sql=parent::$connection->prepare("INSERT INTO `hashtag_question`(`id_hashtag`, `id_question`) VALUES ".$questionMarks); 
        $sql->bind_param($types,...$arrResult); 
        $sql->execute(); 
        return true; 
        }catch(Throwable $th) { 
            echo("Có lỗi xảy ra trong Hashtag/insertHashtagQuestion: ".$th); 
            return false; 
        }
    }

}