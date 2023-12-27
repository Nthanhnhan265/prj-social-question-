<?php 
class Database { 
    static $connection; 
    //khởi tạo database 
    public function __construct() { 
        if(!self::$connection) { 
            self::$connection=new mysqli(DB_LOCALHOST,DB_USER,DB_PASS,DB_NAME); 
            self::$connection->set_charset('utf8mb4'); 
        }
    }

    //Lớp nào kế thừa lớp DB này sẽ cho câu truy vấn trong phương thức của lớp đó vào trong phương thức select của lớp cha, sau đó lớp cha sẽ thực hiện câu truy vấn qua execute() và truyền vào trong biến $item với kiểu mảng associative cuối cùng trả về $item; 
    public function select($sql) { 
        $sql->execute(); 
        $item=$sql->get_result()->fetch_all(MYSQLI_ASSOC); 
        return $item; 
    }
    
}