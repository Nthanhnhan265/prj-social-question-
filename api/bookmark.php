<?php
require('../config/config.php'); 
$bookmarkModule=new Bookmark(); 

if($_SERVER['REQUEST_METHOD']==='POST') { 
    try {
        $data=json_decode(file_get_contents("php://input",true)); 
        if(!empty($_SESSION['username']) && !empty($data)) { 
            $username=$_SESSION["username"]; 
            $id_question=$data->id_question; 
            $response=["success"=>"ok"]; 
            //Gọi hàm thực thi gán bookmark nếu chưa chèn, hủy nếu đã chèn
            if($bookmarkModule->implementBookmark($username,$id_question)) { 
                $response+=["status"=>"insertedSuccessfully"]; 
            }else { 
                $response+=["status"=>"failed"]; 
            }
            //Trả về trạng thái 
            header("Content-Type:application/json");
            echo(json_encode($response)) ;    
        }else { 
            header("Content-Type:application/json");
            echo(json_encode(["success"=>"ok", "status"=>"undefined User or null data","data"=>$data])) ;        
        }
    }catch(Throwable $th) { 
        header("Content-Type:application/json");
        echo(json_encode(["success"=>"ok", "status"=>"err".$th])) ;
    }
}
else { 
    header("Content-Type:application/json");
    echo(json_encode(["success"=>"ok", "status"=>"err"])) ;
}