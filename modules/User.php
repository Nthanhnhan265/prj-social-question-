 <?php 
    class User extends Database { 
        // //Fields 
        // private $username;
        // private $password; 
        // private $joinAt; 
        // private $description;
        // private $firstName; 
        // private $lastName; 
        // private $avatar; 
        //phương thức kiểm tra user đã tồn tại hay chưa 
        public function CheckUser($uesrname) { 
           $sql=parent::$connection->prepare("SELECT * FROM USERS WHERE username=?"); 
           $sql->bind_param("s",$username); 
           $user=parent::select($sql) ; 
           if(count($user)>0) { 
               echo(count($user)); 
               return true;
           }
           return false; 
        }
        //Phương thức lấy tất cả users trong trang 
        public function getUsersInPage($startPage,$perPage) { 
            $sql=parent::$connection->prepare("SELECT * FROM USERS limit $startPage,$perPage");
            return parent::select($sql ) ;
        }
        //Phương thức lấy tất cả users 
        public function getAllUsers() { 
            $sql=parent::$connection->prepare("SELECT * FROM USERS");
            return parent::select($sql ) ;
        }
        //Phương thức đăng kí tài khoản (Insert user mới vào trong DB)
        public function SignUp($username,$password,$joinAt,$description,$firstName,$lastName,$avatar) { 
           try {
            if($this->CheckUser($username)) { 
                return false; 
            }            


            $sql=parent::$connection->prepare("INSERT INTO `users`(`username`, `password`, `joined_at`, `description`, `firstname`, `lastname`, `avatar`) 
            VALUES (?,?,?,?,?,?,?)"); 
            //mã hóa mật khẩu 
            $password=password_hash($password, PASSWORD_DEFAULT);
            $sql->bind_param("sssssss",$username,$password,$joinAt,$description,$firstName,$lastName,$avatar); 
            $sql->execute(); 
            return true; 

           } catch (Throwable $th) {
            echo("Thêm thất bại! có lỗi xảy ra trong Module/User/SignUp".$th); 
        }
        return false; 

        }
        

        //Phương thức đăng nhập tài khoản 
        public function SignIn($username) { 
            try {
             $sql=parent::$connection->prepare("SELECT * FROM USERS WHERE username=?"); 
             //mã hóa mật khẩu 
             $sql->bind_param("s",$username); 
             $user=parent::select($sql) ; 
             if(!empty($user)) { 
                 return $user[0];

             }

            } catch (\Throwable $th) {
             echo("Thất bại, có lỗi xảy ra trong Module/User/SignIn"); 
             return false; 
            }
         }

         //Phương thức trả về thông tin của 1 người dùng 
         public function getUserByUsername($username) {
            try {
                $sql=parent::$connection->prepare("SELECT * FROM USERS WHERE username=?"); 
                //mã hóa mật khẩu 
                $sql->bind_param("s",$username); 
                $user=parent::select($sql) ; 
                if(!empty($user)) { 
                    return $user[0];
                }
   
               } catch (\Throwable $th) {
                echo("Thất bại, có lỗi xảy ra trong Module/User/getUserByUsername: ".$th); 
                return false; 
               }
         }

    }


