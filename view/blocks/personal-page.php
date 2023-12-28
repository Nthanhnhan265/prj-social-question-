<div class="personal-information bg-component p-3 mt-2">
    <div class="container-fluid generalInfo">
        <div class="row">
            <div class="col-sm-1"><img class='avatar' src="../public/avatar/<?php echo ($user['avatar']); ?> " alt="">
            </div>
            <div class="col-sm-9">
                <h4>
                    <?php
                    echo (ucwords($user['lastname'] . " " . $user['firstname']));
                    ?>
                </h4>
                <p class="dateQuestion">
                    <?php
                    $date = date_create($user['joined_at']);
                    echo (date_format($date, "d/m/Y")); ?>
                </p>
            </div>
            <div class="col-sm-2 text-center">
                <!-- <button type="button" class="btn btn-outline-blue" data-bs-toggle="modal" data-bs-target=""> -->
                <?php 
                if(!empty($_SESSION['username']) && $user['username']==$_SESSION['username']) { 
                    echo('<a href="user.php" style="text-decoration: none;">Chinh sua</a>');}
                ?>    
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
            <h6 class='list px-3 py-2 <?php
            if (!empty($_GET['page']) && $page == 'answered') {
                echo ('active');
            } ?> '><a class="text-decoration-none text-black " href="personal-info?user=<?php echo($user['username']); ?>&page=answered">Answer</a></h6>
            <h6 class='list px-3 py-2 <?php
            if (!empty($_GET['page']) && $page == 'asked') {
                echo ('active');
            } ?> '><a class="text-decoration-none text-black " href="personal-info?user=<?php echo($user['username']); ?>&page=asked">Question</a></h6>
            <h6 class='list px-3 py-2 <?php
            if (!empty($_GET['page']) && $page == 'marked') {
                echo ('active');
            } ?> '><a class="text-decoration-none text-black " href="personal-info?user=<?php echo($user['username']); ?>&page=marked">Bookmark</a></h6>
        </div>
    </div>

</div>
<div class="content-feature overflow-auto">
    <?php

    if (!empty($answers) && $page == 'answered') {
        foreach ($answers as $answer) {
            echo ('<div class="answers pe-4 mb-3">');
            echo ("<div class='headerQuestion text-blue bg-content-gray p-1'><a href='question.php?q=" . $answer['id_question'] . "'><h6>" . $answer['question'] . "</h6></a></div>");
            echo ('
                    <div class="answer row pb-2 mt-3">
                        <!-- phần avartar -->
                        <div class="col-1">
                          <div class="avatarQuestion">
                          <img src="../public/avatar/' . $answer['avatar'] . '" alt="err">
                
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="authorAnswer">
                          ' . ucwords($answer['lastname'] . ' ' . $answer['firstname']) . '
                          </div>
                          <div class="dateAnswer">
                           ' . (
                date_format(date_create($answer['created_at']), "d/m/Y H:s")


            ) . '
                          </div>
                    
                        </div>
                        '.( !empty($_SESSION['username']) && $user['username']==$_SESSION['username']?'
                        <div class="col-2 d-flex justify-content-end"> 
                        <button class="btn btns-edit" data-toggle="modal" data-target="#">
                            <span class="text-none-color material-symbols-outlined btns-editAnswer">
                            edit
                            </span>
                        </button>

                        <button class="btn btns-deleteAnswer" data-id-answer="'.$answer['id_answer'].'" data-toggle="modal" data-target="#confirm-delete-answer">
                            <span class="ps-1 material-symbols-outlined text-red ">
                            delete
                            </span>
                        </button>
                        </div>
                        ':'').'
                        <!--  CONTENT -->
                        <div class="contentAnswer pt-1 ps-4">
                           ' . $answer['content'] . '
                        </div>
                        <!-- Vote -->
                        <div class="d-flex align-items-center featureAnswer mt-4" id="updownvote-answer1">
                        <span class="material-symbols-outlined">
                        arrow_drop_up
                        </span>' . $answer['upvote'] . '<span class="material-symbols-outlined">
                        arrow_drop_down
                        </span>' . $answer['downvote'] . '
                        </div>
                      </div>');
            echo ('
                   ');


            echo ('</div>');

        }
    }

    if (!empty($questions) && $page == 'asked') {
        foreach ($questions as $question) {
            ?>
            <div class="questionBlock mb-2" id="idQuestion<?php echo ($question["id"]); ?>">
                <div class="row infoQuestion mb-3">
                    <!-- phần avartar -->
                    <div class="col-1 ps-0">
                        <div class="avatarQuestion">
                            <img src="<?php
                            if(!empty($user['avatar'])) { 
                                echo("avatar/".$user['avatar']);

                            }else { 
                                echo('avatar/default.png'); 
                            }
                            ?> 
                            
                            
                            " alt="" srcset="">

                        </div>

                    </div>
                    <!-- phần họ tên -->
                    <div class="col-10">
                        <div class="authorQuestion">
                            <?php
                            $user = $userModule->getUserByUsername($question["author"]);
                            echo (ucwords($user["lastname"] . " " . $user["firstname"]));


                            ?>
                        </div>
                        <div class="dateQuestion">
                            <?php
                            $date = date_create($question["created_at"]);
                            echo (date_format($date, "d/m/Y")); ?>
                        </div>

                    </div>
                    <!-- phần nút xoa, chinh sua -->
                    <div class="col-1 d-flex">
                        <?php if(!empty($_SESSION['username'])&&$user['username'] == $_SESSION['username']){?>
                            <button type="button" class="btn p-0 btns-edit" data-id-question="<?php echo($question['id']);  ?>" data-toggle="modal" data-target="#">
                                <span class="text-none-color material-symbols-outlined">
                                  edit
                                </span>
                            
                        </button>
                        <button type="button" class="btn p-0 btns-delete" data-id-question="<?php echo($question['id']);  ?>" data-toggle="modal" data-target="#confirm-delete">
                            <span class="ps-1 material-symbols-outlined text-red">
                               delete
                            </span>

                        </button>
                        <?php }?>
                    </div>
                </div>
                <!-- <div class="headingQuestion"><h4>heading</h4></div> -->
                <div class="contentQuestion"> <b>
                        <?php
                        echo ($question["content"]);
                        ?>
                    </b>
                </div>
                <!-- IMGs -->
                <div class="imgsQuestion mb-1 mt-4 ms-3 d-flex overflow-auto">
                    <?php
                    if (!empty($imagesList)) {
                        for ($i = 0; $i < count($imagesList); $i++) {
                            //  echo($imagesList[$i]['imgs']$question['id']);
                            if ($imagesList[$i]['id_question_answer'] === $question['id']) {
                                $srcImgs = explode(',', $imagesList[$i]['imgs']);
                                foreach ($srcImgs as $srcImg) {
                                    echo ('<a class="imgsList thumbnail fancybox" rel="' . $question['id'] . '" href="images/' . $srcImg . '" data-fancybox="images" data-caption="Image 1" ><img class="imgsList img-responsive" src="' . 'images/' . $srcImg . '"></a>');
                                }

                            }

                        }

                    }
                    ?>




                </div>
                <!-- Hashtags -->
                <?php foreach ($tagsOfQuestions as $arr) {
                    if ($question["id"] == $arr["id_question"]) {
                        $arrTags = explode(',', $arr["tags"]);
                        foreach ($arrTags as $tag) {
                            echo ('<a href="hashtag.php?tag=' . $tag . '" class="badge badge-danger me-1">' . $tag . '</a>');
                        }

                    }
                } ?>

                <!-- Vote -->
                <div class="featureQuestion mt-4" id="updownvote<?php echo ($question['id']); ?>">
                    <button class="btn btn-outline-purple-nohover py-1 d-inline btnsUpVote <?php
                    //Kiểm tra nếu người dùng đã vote thì hiện trạng thái
                    if (in_array($question["id"], explode(',', $upVotedQuestions))) {
                        echo ("active");
                    }
                    ?>" data-id-question="<?php echo ($question["id"]); ?>">
                        <p class="m-0"><i class="fa fa-angle-up text-purple" aria-hidden="true"></i>
                            Upvote <span class="upvoteValue">
                                <?php
                                // if($question["upvote"]>0) { 
                                echo ($question["upvote"]);

                                // }
                                ?>
                            </span></p>
                    </button>
                    <button class="btn btn-outline-purple-nohover py-1 btnsDownVote <?php
                    //Kiểm tra nếu người dùng đã đown vote thì hiện trạng thái  
                    if (in_array($question["id"], explode(',', $downVotedQuestions))) {
                        echo ("active");
                    }
                    ?>" data-id-question="<?php echo ($question["id"]); ?>">
                        <p class="m-0"><i class="fa fa-angle-down text-purple " aria-hidden="true"></i>
                        </p>

                    </button>
                    <button class="btn btn-outline-blue mx-1 py-1 btnsShowAnswer"
                        data-id-question="<?php echo ($question["id"]); ?>" data-bs-toggle="modal" data-bs-target="#showAnswer">
                        <i class="fa fa-comments text-blue" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <?php


        }
    }

    if (!empty($bookmarks) && $page == 'marked') {
        foreach ($questions as $question) {
            ?>
            <div class="questionBlock mb-2" id="idQuestion<?php echo ($question["id"]); ?>">
                <div class="row infoQuestion mb-3">
                    <!-- phần avartar -->
                    <div class="col-1 ps-0">
                        <div class="avatarQuestion">
                            <img src="<?php
                            $author=$userModule->getUserByUsername($question['author']); 
                            if(!empty($author['avatar'])) { 
                                echo("avatar/".$author['avatar']);

                            }else { 
                                echo('avatar/default.png'); 
                            }
                            ?> " alt="" srcset="">

                        </div>

                    </div>
                    <!-- phần họ tên -->
                    <div class="col-10">
                        <div class="authorQuestion">
                            <?php
                            $user = $userModule->getUserByUsername($question["author"]);
                            echo (ucwords($user["lastname"] . " " . $user["firstname"]));


                            ?>
                        </div>
                        <div class="dateQuestion">
                            <?php
                            $date = date_create($question["created_at"]);
                            echo (date_format($date, "d/m/Y")); ?>
                        </div>

                    </div>
                    <!-- phần nút like, share -->
                    <div class="col-1">
                        <img width="23" height="23" src="https://img.icons8.com/ios/50/forward-arrow.png" alt="forward-arrow" />
                        <a href="personal-info?page=marked">
                            <img width="24" height="24" src="https://img.icons8.com/windows/50/<?php
                            if (!empty($markedQuestions) && in_array($question['id'], explode(',', $markedQuestions["questions"]))) {
                                echo ("filled-bookmark-ribbon");
                            } else {
                                echo ("bookmark-ribbon--v1");
                            }
                            ?>.png" alt="error" data-id-question="<?php echo ($question["id"]); ?>" class="btnsBookmark"
                                bookmarked-state="filled-bookmark-ribbon" unbookmarked-state="bookmark-ribbon--v1" is-clicked="<?php
                                if (!empty($markedQuestions) && in_array($question['id'], explode(',', $markedQuestions["questions"]))) {
                                    echo ("true");
                                } else {
                                    echo ("false");
                                }
                                ?>" />

                        </a>
                    </div>
                </div>
                <!-- <div class="headingQuestion"><h4>heading</h4></div> -->
                <div class="contentQuestion"> <b>
                        <?php
                        echo ($question["content"]);
                        ?>
                    </b>
                </div>
                <!-- IMGs -->
                <div class="imgsQuestion mb-1 mt-4 ms-3 d-flex overflow-auto">
                    <?php
                    if (!empty($imagesList)) {
                        for ($i = 0; $i < count($imagesList); $i++) {
                            //  echo($imagesList[$i]['imgs']$question['id']);
                            if ($imagesList[$i]['id_question_answer'] === $question['id']) {
                                $srcImgs = explode(',', $imagesList[$i]['imgs']);
                                foreach ($srcImgs as $srcImg) {
                                    echo ('<a class="imgsList thumbnail fancybox" rel="' . $question['id'] . '" href="images/' . $srcImg . '" data-fancybox="images" data-caption="Image 1" ><img class="imgsList img-responsive" src="' . 'images/' . $srcImg . '"></a>');
                                }

                            }

                        }

                    }
                    ?>




                </div>
                <!-- Hashtags -->
                <?php foreach ($tagsOfQuestions as $arr) {
                    if ($question["id"] == $arr["id_question"]) {
                        $arrTags = explode(',', $arr["tags"]);
                        foreach ($arrTags as $tag) {
                            echo ('<a href="hashtag.php?tag=' . $tag . '" class="badge badge-danger me-1">' . $tag . '</a>');
                        }

                    }
                } ?>

                <!-- Vote -->
                <div class="featureQuestion mt-4" id="updownvote<?php echo ($question['id']); ?>">
                    <button class="btn btn-outline-purple-nohover py-1 d-inline btnsUpVote <?php
                    //Kiểm tra nếu người dùng đã vote thì hiện trạng thái
                    if (in_array($question["id"], explode(',', $upVotedQuestions))) {
                        echo ("active");
                    }
                    ?>" data-id-question="<?php echo ($question["id"]); ?>">
                        <p class="m-0"><i class="fa fa-angle-up text-purple" aria-hidden="true"></i>
                            Upvote <span class="upvoteValue">
                                <?php
                                // if($question["upvote"]>0) { 
                                echo ($question["upvote"]);

                                // }
                                ?>
                            </span></p>
                    </button>
                    <button class="btn btn-outline-purple-nohover py-1 btnsDownVote <?php
                    //Kiểm tra nếu người dùng đã đown vote thì hiện trạng thái  
                    if (in_array($question["id"], explode(',', $downVotedQuestions))) {
                        echo ("active");
                    }
                    ?>" data-id-question="<?php echo ($question["id"]); ?>">
                        <p class="m-0"><i class="fa fa-angle-down text-purple " aria-hidden="true"></i>
                        </p>

                    </button>
                    <button class="btn btn-outline-blue mx-1 py-1 btnsShowAnswer"
                        data-id-question="<?php echo ($question["id"]); ?>" data-bs-toggle="modal" data-bs-target="#showAnswer">
                        <i class="fa fa-comments text-blue" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <?php


        }
    }
    ?>
    <!-- ấn để hiển thị trả lời câu hỏi -->
    <div class="modal fade" id="showAnswer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="idDialogAnswer">
            <div class="modal-content" id="idContainAnswer">
                <!-- HEADER -->
                <div class="modal-header d-flex">
                    <button type="button" id="bntAnswerClose" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <!-- ANSWERS -->
                <div class="modal-body ps-5">
                    <div id="idHeaderInfo pb-5" class="">
                        <div class="row infoQuestion mb-3">
                            <!-- phần avartar -->
                            <div class="col-1">
                                <div id="idAvatarQuestion" class="avatarQuestion">
                                    <img src="<?php
                            if(!empty($user['avatar'])) { 
                                echo("avatar/".$user['avatar']);

                            }else { 
                                echo('avatar/default.png'); 
                            }
                            ?> " alt="err">
                                </div>

                            </div>
                            <!-- phần họ tên -->
                            <div class="col-10">
                                <div id="idAuthorQuestion" class="authorQuestion">Ex</div>
                                <div id="idDateQuestion" class="dateQuestion">Ex</div>
                            </div>
                            <!-- phần nút like, share -->
                            <div class="col-1">

                            </div>
                        </div>
                        <h5 id="idHeadingQuestion" class="contentQuestion px-1">
                            text default
                        </h5>
                        <!-- Vote -->
                        <div class="featureQuestion mt-4 ms-2" id="updownvote<?php echo ($question['id']); ?>">
                            <button class="btn btn-outline-purple-nohover py-1 d-inline btnsUpVote"
                                id='idUpvoteQuestion'>
                                <p class="m-0"><i class="fa fa-angle-up text-purple" aria-hidden="true"></i>
                                    Upvote <span id="upvoteValueModal">0</span></p>
                            </button>
                            <button class="btn btn-outline-purple-nohover py-1 btnsDownVote" id='idDownvoteQuestion'>
                                <p class="m-0"><i class="fa fa-angle-down text-purple " aria-hidden="true"></i>
                                </p>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <textarea name="inputAnswer" id="inputAnswer" class='summernote' rows="2" class="p-0"></textarea>
                    <div class="ms-3" id="answersForQuestion">

                    </div>

                </div>

                <div class="modal-footer row justify-content-start" contenteditable="true">
                    <div class="col-10 ms-1">
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-bg-blue" id="idBtnAnswer">Answer</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Xác nhận xem người dùng có đồng ý xóa -->
    <div class="modal" id="confirm-delete"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete?</p>
          </div>
          <div class="modal-footer">
            <form action="process/delete-question.php" method="post">
                <input type="hidden" name='id_question' id="idHiddenQuestion">
                <button type="submit" class="btn btn-warning">Delete</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Xác nhận xem người dùng có đồng ý xóa -->
    <div class="modal" id="confirm-delete-answer"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete?</p>
          </div>
          <div class="modal-footer">
            <form action="process/delete-answer.php" method="post">
                <input type="hidden" name='id_answer' id="idHiddenAnswer">
                <button type="submit" class="btn btn-warning">Delete</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>

<script>
$('#confirm-delete').on('shown.bs.modal', function () {
  $('#confirm-delete').trigger('focus')
})

</script>