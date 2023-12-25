<?php 
class Images extends Database {
    
    //Lấy tất hình ảnh của một question hoặc answer
    public function getAllImagesByID($id,$type) { 
     $sql=parent::$connection->prepare('SELECT * FROMS IMAGES WHERE id_question_answer=? and type=?');   
     $sql->bind_param('is',$id,$type);
     return parent::select($sql); 
    } 

    //Phương thức lấy tất cả hình ảnh 
    public function getAllImages($type) {
        $sql=parent::$connection->prepare('SELECT GROUP_CONCAT(id_img) as imgs, id_question_answer FROM IMAGES WHERE type=? GROUP BY (id_question_answer)');   
        $sql->bind_param('s',$type);
        return parent::select($sql);        
    } 

    //Thêm mảng hình ảnh vào database  
    public function inserstImages($arr_id_img,$id_question_answer,$type)  { 
        try {
            //code...
            $questionMarks=str_repeat('(?,?,?),',count($arr_id_img)-1).'(?,?,?)';
            $result=[]; 
            $types=str_repeat('sis',count($arr_id_img)); 
            $sql=parent::$connection->prepare('INSERT INTO images(id_img,id_question_answer,type) values '.$questionMarks);
            //Thêm vào mảng chuẩn bị bind param 
            foreach($arr_id_img as $id_img) { 
                $result[]=$id_img;
                $result[]=$id_question_answer; 
                $result[]=$type; 
            }           
            $sql->bind_param($types,...$result); 
            $sql->execute(); 
            return true; 
        } catch (\Throwable $th) {
            echo("co loi xay ra trong Images/insertImages".$th); 
            return false; 
        }
    }

    // Xóa 1 tấm hình khi có mã hình ảnh, được dùng khi user click nút xóa cho 1 hình ảnh
    public function deleteImagesByID_img($id_img) { 

        try {
            //code...
            $sql=parent::$connection->prepare('delete from images where id_img=?');
            $sql->bind_param('i',$id_img); 
            $sql->execute();
            return true;  
        } catch (\Throwable $th) {
            echo("co loi xay ra trong Images/insertImages".$th); 
            return false; 
        }



    } 

}