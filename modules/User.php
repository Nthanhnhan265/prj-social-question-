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

        //Phương thức đăng kí tài khoản (Insert user mới vào trong DB)
        public function SignUp($username, $firstName, $lastName, $password, $join_At, $avatar)
        {
            try {
                if ($this->CheckUser($username)) {
                    return false;
                }
                
                $sql = parent::$connection->prepare("INSERT INTO `users`(`username`, `firstname`, `lastname`, `password`, `joined_at`, `avatar`) 
            VALUES (?,?,?,?,?,?)");
                //mã hóa mật khẩu 
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql->bind_param("ssssss", $username, $firstName, $lastName, $password, $join_At, $avatar);
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


    // $error = display_error("Please Fill in the Blank");

    // set_message(display_error("Please Fill in the Blank"));

    // Sucess Message
    function display_success($success)
    {
        return "<p class='alert alert-success text-center'>$success</p>";
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