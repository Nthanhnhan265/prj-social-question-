<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="personal-information border-purple p-3">
        <div class="container-fluid generalInfo">
            <div class="row">
                <img src="" alt="">
                <div class="col-sm-1"><img src="../public/avatar/<?php  echo ($user['avatar']); ?> " alt=""></div>
                <div class="col-sm-9">
                    <h4>
                    <?php
                        echo ($user['lastname']." ".$user['firstname']);
                    ?>
                    </h4>
                    <p><?php echo($user['joined_at']);?></p>
                </div>
                <div class="col-sm-2 text-center">
                <button type="button" class="btn btn-outline-blue" data-bs-toggle="modal" data-bs-target="">
                <a href="user.php" style="text-decoration: none;">Chinh sua</a>
                </div>
            </div>
        </div>
        <div class="description mt-1 container-fluid">
            <h6>Description</h6>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam officiis et, quo voluptatum nesciunt labore
            fuga deleniti vero, eveniet odio fugit beatae sapiente rem unde. Aliquam maiores fuga obcaecati sint!
        </div>

        <div class="feature mt-5">
            <div class="d-flex justify-content-around">
                <h6><a class="text-decoration-none text-black" href="#">Share</a></h6>
                <h6><a class="text-decoration-none text-black" href="#">Answer</a></h6>
                <h6><a class="text-decoration-none text-black" href="#">Question</a></h6>
                <h6><a class="text-decoration-none text-black" href="#">Bookmark</a></h6>
            </div>
            <hr>
        </div>

    </div>

</body>

</html>