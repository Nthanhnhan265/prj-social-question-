<?php
class User extends Database
{
    // //Fields 
    // private $username;
    // private $password; 
    // private $joinAt; 
    // private $description;
    // private $firstName; 
    // private $lastName; 
    // private $avatar; 

    public function search($string)
    {
        $sql = parent::$connection->prepare("select * from users where username like ? or firstname like ? or lastname like ?");
        $string = "%$string%";
        $sql->bind_param("sss", $string, $string, $string);
        return parent::select($sql);
    }



    //phương thức kiểm tra user đã tồn tại hay chưa 
    public function CheckUser($username)
    {
        $sql = parent::$connection->prepare("SELECT * FROM USERS WHERE username=?");
        $sql->bind_param("s", $username);
        $user = parent::select($sql);
        if (count($user) > 0) {
            echo (count($user));
            return true;
        }
        return false;
    }
    //Phương thức lấy tất cả users trong trang 
    public function getUsersInPage($startPage, $perPage)
    {
        $sql = parent::$connection->prepare("SELECT * FROM USERS limit $startPage,$perPage");
        return parent::select($sql);
    }
    //Phương thức lấy tất cả users 
    public function getAllUsers()
    {
        $sql = parent::$connection->prepare("SELECT * FROM USERS");
        return parent::select($sql);
    }
    //Phương thức đăng kí tài khoản (Insert user mới vào trong DB)
    public function SignUp($username, $firstName, $lastName, $password, $joinAt, $avatar)
    {
        try {
            if ($this->CheckUser($username)) {
                return false;
            }

            $sql = parent::$connection->prepare("INSERT INTO `users`(`username`, `firstname`, `lastname`, `password`, `joined_at`, `avatar`) 
            VALUES (?,?,?,?,?,?)");
            //mã hóa mật khẩu 
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql->bind_param("ssssss", $username, $firstName, $lastName, $password, $joinAt, $avatar);
            $sql->execute();
            return true;
        } catch (Throwable $th) {
            echo ("Thêm thất bại! có lỗi xảy ra trong Module/User/SignUp" . $th);
        }
        return false;
    }


    //Phương thức đăng nhập tài khoản 
    public function SignIn($username)
    {
        try {
            $sql = parent::$connection->prepare("SELECT * FROM USERS WHERE username=?");
            //mã hóa mật khẩu 
            $sql->bind_param("s", $username);
            $user = parent::select($sql);
            if (!empty($user)) {
                return $user[0];
            }
        } catch (\Throwable $th) {
            echo ("Thất bại, có lỗi xảy ra trong Module/User/SignIn");
            return false;
        }
    }

      


        //Phương thức trả về thông tin của 1 người dùng 
        public function getUserByUsername($username)
        {
            try {
                $sql = parent::$connection->prepare("SELECT * FROM USERS WHERE username=?");
                //mã hóa mật khẩu 
                $sql->bind_param("s", $username);
                $user = parent::select($sql);
                if (!empty($user)) {
                    return $user[0];
                }
            } catch (\Throwable $th) {
                echo ("Thất bại, có lỗi xảy ra trong Module/User/getUserByUsername: " . $th);
                return false;
            }
        }

        


        // Phương thức trả về role
        public function getRoleByUsername($username)
        {
            try {
                $sql = parent::$connection->prepare("SELECT role FROM USERS WHERE username=?");
                $sql->bind_param("s", $username);
                $result = parent::select($sql);
                if (!empty($result)) {
                    return $result[0]['role'];
                }
            } catch (\Throwable $th) {
                echo ("Thất bại, có lỗi xảy ra trong Module/User/getRoleByUsername: " . $th);
                return false;
            }
        }

        // Phương thức xóa người dùng
        public function deleteUserByUsername($username)
        {
            try {
                // Kiểm tra xem tài khoản đang đăng nhập có trùng với tài khoản cần xóa hay không
                if ($_SESSION['username'] == $username) {
                    return false;
                }
                $sql = parent::$connection->prepare("DELETE FROM USERS WHERE username = ?");
                $sql->bind_param("s", $username);
                // Thực hiện truy vấn xóa
                $success = $sql->execute();
                if ($success) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                echo "Thất bại, có lỗi xảy ra trong Module/User/deleteUserByUsername: " . $th;
                return false;
            }
        }

        // Phương thức cập nhật thông tin người dùng
        public function updateUserByUsername($username, $firstname, $lastname, $avatar)
        {
            try {
                $sql = parent::$connection->prepare("UPDATE USERS SET firstname = ?, lastname = ?, avatar = ? WHERE username = ?");
                $sql->bind_param("ssss", $firstname, $lastname, $avatar, $username);

                // Thực hiện truy vấn cập nhật
                $success = $sql->execute();

                if ($success) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                echo "Thất bại, có lỗi xảy ra trong Module/User/updateUserByUsername: " . $th;
                return false;
            }
        }

        // Phương thức cập nhật thông tin người dùng, nhưng không cập nhật hình ảnh
        public function updateUserByUsernameExistAvatar($username, $firstname, $lastname)
        {
            try {
                $sql = parent::$connection->prepare("UPDATE USERS SET firstname = ?, lastname = ? WHERE username = ?");
                $sql->bind_param("sss", $firstname, $lastname, $username);

                // Thực hiện truy vấn cập nhật
                $success = $sql->execute();

                if ($success) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                echo "Thất bại, có lỗi xảy ra trong Module/User/updateUserByUsernameExistAvatar: " . $th;
                return false;
            }
        }
    



// public function getUserByUsername()
//     {
//         try {
//             $sql = parent::$connection->prepare("SELECT * FROM USERS WHERE username=?");
//             //mã hóa mật khẩu 
//             $sql->bind_param("s", $username);
//             $user = parent::select($sql);
//             if (!empty($user)) {
//                 return $user[0];
//             }
//         } catch (\Throwable $th) {
//             echo ("Thất bại, có lỗi xảy ra trong Module/User/getUserByUsername: " . $th);
//             return false;
//         }
//     }

    // Phương thức trả về avatar
    public function getAvatarByUsername($username)
    {
        try {
            $sql = parent::$connection->prepare("SELECT avatar FROM USERS WHERE username=?");
            $sql->bind_param("s", $username);
            $result = parent::select($sql);
            if (!empty($result)) {
                return $result[0]['avatar'];
            }
        } catch (\Throwable $th) {
            echo ("Thất bại, có lỗi xảy ra trong Module/User/getAvatarByUsername: " . $th);
            return false;
        }
    }
    //Phuong thuc chinh sua thong tin ca nhan
    public function editInformation($firstname, $lastname, $description,$avatar, $username)
    {
        try {
            $sql = parent::$connection->prepare("UPDATE users SET firstname=?, lastname=?, description=?, avatar=? WHERE username=?");
            $sql->bind_param('sssss', $firstname, $lastname, $description,$avatar, $username);
            $sql->execute();

            return true;
        } catch (\Throwable $th) {
            echo ("$th");
            return false;
        }

    }

    public function changePassword($oldPassword, $newPassword, $username)
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = $this->getUserByUsername($username);

        // Kiểm tra xem có người dùng hay không
        if (!$user) {
            echo 'Người dùng không tồn tại.';
            return;
        }

        // Chuỗi đã hash từ cơ sở dữ liệu
        $hashedPasswordFromDatabase = $user['password'];

        // Kiểm tra xem mật khẩu cũ có khớp hay không
        if (password_verify($oldPassword, $hashedPasswordFromDatabase)) {
            // Hash mật khẩu mới trước khi cập nhật vào cơ sở dữ liệu
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $sql = parent::$connection->prepare('UPDATE users SET password=? WHERE username=?');
            $sql->bind_param('ss', $hashedNewPassword, $username);

            if ($sql->execute()) {
                echo 'Mật khẩu đã được thay đổi thành công.';
            } else {
                echo 'Có lỗi xảy ra khi cập nhật mật khẩu.';
            }
        } else {
            echo 'Mật khẩu cũ không đúng.';
        }
    }





function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['MESSAGE'] = $msg;
    } else {
        $msg = "";

    }
}


// Display Message
function display_message()
{
    if (isset($_SESSION['MESSAGE'])) {
        echo $_SESSION['MESSAGE'];
        unset($_SESSION['MESSAGE']);
    }
}

// Error Message
function display_error($error)
{
    return "<p class='alert alert-danger text-center'>$error</p>";
}


    // Sucess Message
    function display_success($success)
    {
        return "<p class='alert alert-success text-center'>$success</p>";
    }


// $error = display_error("Please Fill in the Blank");

// set_message(display_error("Please Fill in the Blank"));

// Sucess Message

}
// function login_system()
// {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_signin'])) {
//         $userModule = new User();

//         if (empty($_POST["username"]) || empty($_POST["password"])) {
//             set_message(display_error("Please fill in the blanks!"));
//         }else{
//             $username = $_POST["username"];
//             $password = $_POST["password"];
//             $user = $userModule->SignIn($username);
//             if (!empty($user)) {
//                 if (password_verify($password, $user["password"])) {
//                     setcookie("username", $username, time() + 86400 * 30);
//                     setcookie("password", $user["password"], time() + 86400 * 30);
//                     $_SESSION["username"] = $username;
//                     $_SESSION["avt"] = $userModule->getAvatarByUsername($username);
//                     // echo '<script>alert("Đăng nhập thành công!"); window.location.href="./index.php";</script>';
//                     header("location: ./index.php");
//                 } else {
//                     // header("location: ./index.php");
//                     // echo '<script>alert("Mật khẩu không đúng! Vui lòng kiểm tra lại"); window.location.href="./index.php";</script>';
//                     set_message(display_error("Please check your password again!"));
//                 }
//             } else {
//                 // header("location: ./index.php");
//                 // echo '<script>alert("Vui lòng kiểm tra lại tên tài khoản"); window.location.href="./index.php";</script>';
//                 set_message(display_error("Please check your account name again"));
//             }
//         }
//     }
// }
?>