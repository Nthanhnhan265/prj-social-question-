$(document).ready(function () {
    save_user_record();
    login_user_record();
})

// save user record fun
function save_user_record() {
    $(document).on('click', '#btn_register', function () {

        var name = $('#username_regis').val();
        var lastname = $('#lastname_regis').val();
        var firstname = $('#firstname_regis').val();
        var password = $('#password_regis').val();
        var cpassword = $('#retype_regis').val();

        var avtInput = document.getElementById('avt_regis');
        var avt = avtInput.files[0];


        // Tạo một đối tượng FormData
        var formData = new FormData();

        // Thêm thông tin về tệp tin vào FormData
        formData.append('Name', name);
        formData.append('Lastname', lastname);
        formData.append('Firstname', firstname);
        formData.append('Password', password);
        formData.append('Cpassword', cpassword);
        formData.append('Avt', avt);

        var regex = /^[a-zA-Z ]*$/;

        var flag_username = true;
        var flag_lastname = true;
        var flag_firstname = true;
        var flag_password = true;
        var flag_cpassword = true;
        var flag_avt = true;


        // kiem tra username
        if (name === "") {
            $('#error_username_regis').html('Please Fill in the User name');
            flag_username = false;

        } else if (!/^[a-zA-Z0-9\s]+$/.test(name)) {
            $('#error_username_regis').html('User Name should only contain letters, number and spaces.');
            flag_username = false;
        } else {
            $('#error_username_regis').html('');
            flag_username = true;
        }

        // kiem tra lastname

        if (lastname === "") {
            $('#error_lastname_regis').html('Please Fill in the Last name');
            flag_lastname = false;

        } else if (!regex.test(lastname)) {
            $('#error_lastname_regis').html('First Name should only contain letters and spaces.');
            flag_lastname = false;
        } else {
            $('#error_lastname_regis').html('');
            flag_lastname = true;

        }

        // kiem tra firstname

        if (firstname === "") {
            $('#error_firstname_regis').html('Please Fill in the Frist name');
            flag_firstname = false;
        } else if (!regex.test(firstname)) {
            $('#error_firstname_regis').html('Last Name should only contain letters and spaces.');
            flag_firstname = false;
        } else {
            $('#error_firstname_regis').html('');
            flag_firstname = true;

        }


        // kiem tra password

        if (password === "") {
            $('#error_password_regis').html('Please Fill in the Password');
            flag_password = false;
        } else if (password.length < 8) {
            $('#error_password_regis').html('Password should be at least 8 characters long');
            flag_password = false;
        } else {
            $('#error_password_regis').html('');
            flag_password = true;

        }


        // kiem tra cpassword

        if (cpassword === "") {
            $('#error_retype_regis').html('Please Fill in the Confirm Your Password');
            flag_cpassword = false;
        } else if (password != cpassword) {
            $('#error_retype_regis').html('Password Not Matched');
            flag_cpassword = false;
        } else {
            $('#error_retype_regis').html('');
            flag_cpassword = true;

        }


        // kiem tra avt

        if (!avt) {
            $('#error_avt_regis').html('Please Choose Avatar!');
            flag_avt = false;
        } else {
            $('#error_avt_regis').html('');
            flag_avt = true;
        }


        if (flag_username == true && flag_lastname == true && flag_firstname == true && flag_password == true && flag_cpassword == true && flag_avt == true) {
            // Sử dụng AJAX để gửi FormData
            $.ajax({
                url: '../public/ajax/user_register.php',
                method: 'POST',
                data: formData,
                contentType: false, // Không sử dụng contentType để tránh xử lý trước FormData
                processData: false, // Không xử lý dữ liệu trước khi gửi
                success: function (data) {
                    // Xử lý phản hồi từ server

                    console.log(data.trim());
                    if (data.trim() === "Valid") {
                        $('form').trigger('reset');
                        // $('#success').html('Invalid');
                        $('#error_regis').html('');
                        $('#success_regis').html('You have successfully Registed!');
                    }
                    else if (data.trim() == "1Invalid") {
                        $('form').trigger('reset');
                        $('#error_regis').html('Email Already Exits!');
                    }
                }
            });
        }





    })


}

// login user record fun
function login_user_record() {
    $(document).on('click', '#btn_login', function () {
        var username = $('#username_login').val();
        var password = $('#password_login').val();
        // alert(username);
        // alert(password);

        var flag_username = true;
        var flag_password = true;

        // check username
        if (username === "") {
            $('#error_username_login').html('Please Fill in the User name');
            flag_username = false;

        } else if (!/^[a-zA-Z0-9\s]+$/.test(username)) {
            $('#error_username_login').html('User Name should only contain letters, number and spaces.');
            flag_username = false;
        } else {
            $('#error_username_login').html('');
            flag_username = true;
        }

        // check password
        if (password === "") {
            $('#error').html('');
            $('#error_password_login').html('Please Fill in the Password');
            flag_password = false;
        } else if (password.length < 8) {
            $('#error_password_login').html('Password should be at least 8 characters long');
            flag_password = false;
        } else {
            $('#error_password_login').html('');
            flag_password = true;
        }

        if (flag_username == true  && flag_password == true) {
            $.ajax(
                {
                    url: '../public/ajax/login_user.php',
                    method: 'POST',
                    data: { Username: username, Password: password },
                    success: function (data) {
                        // var flag = false;
                        // console.log(data);
                        // console.log("Valid");
                        // console.log('Valid' === data.trim());
                        // console.log('Valid' == data.trim());
                        // console.log("Valid" === data.trim());
                        // console.log("Valid" === data.trim());

                        if (data.trim() === "Valid") {
                            // $('form').trigger('reset');
                            // $('#success').html('Invalid');
                            // $('#error').html('');
                            window.location.href = 'index.php';
                        }

                        else if (data.trim() == "Invalid") {
                            $('#error').html('Check Your Username and Password!');
                            // window.location.href = 'index.php';
                        }

                        // if (flag == true) {
                        //     window.location.href = 'index.php';
                        // }
                    }
                }
            )
        } else {
            $('#error').html('');
        }
    })
}

