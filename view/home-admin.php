<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    if (!empty($title)) {
      echo ($title);
    }

    ?>

  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/styles/styles.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- Fancybox CSS -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body>
  <!-- Phần navbar  -->
  <nav class="navbar navbar-expand-lg p-0 mb-2">
    <div class="container-fluid container-fluid-none">
      <div class="row row-none">
        <div class="col-sm-2">
          <!-- Logo  -->
          <div id="nav-logo-admin">
            <a href="admin.php" class="text-decoration-none text-white">Askany</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="container-fluid nav-edit-admin d-flex">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item icon-active">
                  <a class="nav-link" aria-current="page" href="../public/admin.php"><i class="fa fa-home"></i>
                  </a>
                </li> -->
                <!-- User -->
                <li class="nav-item icon-active">
                  <a class="nav-link" aria-current="page" href="admin.php">
                    <span class="material-symbols-outlined fa">
                      manage_accounts
                    </span>
                  </a>
                </li>
                <!--Question-->
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="question.php">
                    <span class="fa material-symbols-outlined">
                      quiz
                    </span>
                  </a>
                </li>
                <!--Answer-->
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="answer.php">
                    <span class="fa material-symbols-outlined">
                      mode_comment
                    </span>
                  </a>
                </li>
                <!--tag-->
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="hashtag.php">
                    <span class="fa material-symbols-outlined">
                      sell
                    </span>
                  </a>
                </li>
                <!-- Trở về home -->
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="../public/index.php">
                    <span class="ms-2 fa material-symbols-outlined">
                      logout
                    </span>
                  </a>
                </li>
              </ul>
              <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
              </form> -->
            </div>
          </div>

        </div>
        <div class="col-sm-1">
          <!-- Sign in, sign up -->
          <div id="nav-login-admin" class='text-start'>
            <?php if (!empty($_SESSION['username'])) {
              $userAdmin = (new User())->getUserByUsername($_SESSION['username']);
              if (!empty($userAdmin['avatar'])) {
                echo ('<img src="../public/avatar/' . $userAdmin['avatar'] . '" class="ms-3 avatar" alt="">');
              } else {
                echo ('<img src="../public/avatar/default.png" class="ms-3 avatar" alt="">');
              }
              echo ('<p class="mb-0" style="font-size:15px">Hi! ' . ucwords($userAdmin['lastname'] . ' ' . $userAdmin['firstname']) . '</p>');
              echo ('<a href="../public/index.php"></a>');



            } ?>

            <!-- <button type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#sign-in">Sign
              in</button>

            <button type="button" class="btn btn-outline-blue" data-bs-toggle="modal" data-bs-target="#sign-up">Sign
              up</button> -->
          </div>

        </div>
      </div>
    </div>

  </nav>
  <!-- Modal add question  -->
  <div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="process/addquestion.php" method="post" enctype="multipart/form-data">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add your question</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="author" id="author" value="<?php
            if (!empty($_COOKIE["username"])) {
              echo ($_COOKIE["username"]);
            }
            ?>">
            <textarea name="content" id="content" rows="5" placeholder="Type your question"></textarea>
            <label for="imageInput">
              <span class="material-symbols-outlined">
                imagesmode
              </span>

            </label>
            <input type="file" name="images[]" id="imageInput" class="none" accept=".jpg, .png, .jpeg|image/*" multiple>
            <hr>
            <label for="hashtags" class="d-flex align-items-center pb-1">
              <span class="material-symbols-outlined pe-2">sell</span>hashtags
            </label>

            <input type="text" name="hashtags" id="hashtags">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-purple" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-bg-blue">Add question</button>
          </div>
        </div>
      </div>

    </form>
  </div>



  <!-- Modal sign in  -->
  <div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body mt-5">
          <!-- <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                       -->
          <div class="d-flex justify-content-center align-items-center">
            <form class="signin-form p-5" action="signin.php" method="post">
              <h3 class="text-purple pb-2 text-center">Askany</h3>

              <div class="mb-3 px-2">
                <label for="username" class="form-label text-purple">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              </div>
              <div class="mb-3 px-2">
                <label for="password" class="form-label text-purple">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="mb-3 px-2">
                <label for="password" class="form-label">Don't have an account? <a href="#" class="text-blue">Sign up
                    now</a></label>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-bg-purple px-5">Sign in</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal sign up -->
  <div class="modal fade" id="sign-up" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body ">
          <!-- <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
        -->
          <div class="d-flex justify-content-center align-items-center">
            <form class="signin-form p-5 needs-validation" action="signup.php" method="post" novalidate>
              <h3 class="text-purple pb-2 text-center">Askany</h3>

              <div class="mb-3 px-2">
                <label for="username" class="form-label text-purple">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <div class="invalid-feedback">
                  Please, Enter your username
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="mb-3 px-2">
                    <label for="lastname" class="form-label text-purple">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="last name"
                      required>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="mb-3 px-2">
                    <label for="firstname" class="form-label text-purple">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="first name"
                      required>
                  </div>
                </div>
              </div>
              <div class="mb-3 px-2">
                <label for="password" class="form-label text-purple">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                  required>
              </div>
              <div class="mb-3 px-2">
                <label for="retype" class="form-label text-purple">Confirm Your Password</label>
                <input type="retype" class="form-control" id="retype" name="retype" placeholder="Confirm your password"
                  required>
              </div>

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-bg-blue px-5">Sign up</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- Phần nội dung -->
  <div class="container-fluid container-fluid-none">
    <div class="row">
      <!-- Phần thanh bên trái  -->
      <div class="col-2-sm leftBar overflow-auto">
        <?php
        if (!empty($slot)) {
          echo ($slot);
        }
        ?>
      </div>
      <!-- Phần nội dung -->
      <div class="col-10-sm midContent-admin overflow-auto" id="homePageContent">
        <?php
        if (!empty($slot2)) {
          echo ($slot2);
        }

        ?>

      </div>
      <!-- Phần footer -->
      <!-- <div class="col-1-sm rightBar text-center">
        This is footer
      </div> -->
    </div>
  </div>



  <script src="script/app.js">
  </script>
  <script src="script/state.js"></script>
  <script async src="https://cdn.jsdelivr.net/npm/es-module-shims@1/dist/es-module-shims.min.js"
    crossorigin="anonymous"></script>
  <script type="importmap">
    {
      "imports": {
        "@popperjs/core": "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/esm/popper.min.js",
        "bootstrap": "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.esm.min.js"
      }
    }
    </script>
  <script type="module">
    import * as bootstrap from 'bootstrap'

    new bootstrap.Popover(document.getElementById('popoverButton'))
  </script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function () {
      //FANCYBOX
      //https://github.com/fancyapps/fancyBox
      $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none",
        'nextEffect': 'fade',

      });
    });
  </script>
</body>

</html>