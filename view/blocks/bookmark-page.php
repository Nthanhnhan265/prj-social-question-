<?php foreach ($questions as $question) { ?>

  <div class="questionBlock mb-2" id="idQuestion<?php echo($question["id"]);  ?>">
    <div class="row infoQuestion mb-3">
      <!-- phần avartar -->
      <div class="col-1">
        <div class="avatarQuestion">
          <img src="/images/N-0.webp" alt="" srcset="">

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
        <img width="24" height="24" src="https://img.icons8.com/windows/50/<?php
        if (in_array($question['id'], explode(',', $markedQuestions["questions"]))) {
          echo ("filled-bookmark-ribbon");
        } else {
          echo ("bookmark-ribbon--v1");
        }
        ?>.png" alt="error" data-id-question="<?php echo ($question["id"]); ?>" class="btnsBookmark"
          bookmarked-state="filled-bookmark-ribbon" unbookmarked-state="bookmark-ribbon--v1" is-clicked="<?php
          if (in_array($question['id'], explode(',', $markedQuestions["questions"]))) {
            echo ("true");
          } else {
            echo ("false");
          }
          ?>" />
      </div>
    </div>
    <!-- <div class="headingQuestion"><h4>heading</h4></div> -->
    <div class="contentQuestion"> <b>
        <?php
        echo ($question["content"]);
        ?>
      </b>
    </div>
    <div class="imgsQuestion mb-1">
      <!-- IMGs -->
    </div>
    <!-- Hashtags -->
    <?php foreach ($tagsOfQuestions as $arr) {
      if ($question["id"] == $arr["id_question"]) {
        $arrTags = explode(',', $arr["tags"]);
        foreach ($arrTags as $tag) {
          echo ('<a href="#" class="badge badge-danger me-1">' . $tag . '</a>');
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
      <button class="btn btn-outline-blue mx-1 py-1 btnsShowAnswer" data-id-question="<?php echo ($question["id"]); ?>" data-bs-toggle="modal" data-bs-target="#showAnswer">
        <i class="fa fa-comments text-blue" aria-hidden="true"></i>
      </button>
    </div>
  </div>

<?php } ?>
<!-- ấn để hiển thị trả lời câu hỏi -->
<div class="modal fade" id="showAnswer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="idDialogAnswer">
    <div class="modal-content" id="idContainAnswer">
      <div class="modal-header">
        <div id="idHeaderInfo" class="">
          <div class="row infoQuestion mb-3">
            <!-- phần avartar -->
            <div class="col-1">
              <div id="idAvatarQuestion" class="avatarQuestion">

              </div>

            </div>
            <!-- phần họ tên -->
            <div class="col-10">
              <div id="idAuthorQuestion" class="authorQuestion">Ex</div>
              <div id="idDateQuestion" class="dateQuestion">Ex</div>
            </div>
            <!-- phần nút like, share -->
            <div class="col-1">
              <button type="button" id="bntAnswerClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
          </div>
          <h5 id="idHeadingQuestion" class="contentQuestion px-1">
            Who is the strongest guy in the world?
          </h5>
        </div>
      
      </div>
      <div class="modal-body" id="answersForQuestion">
        <div>

        </div>
      </div>
      <div class="modal-footer row justify-content-start">
        <div class="col-10 ms-1">
          <textarea name="inputAnswer" id="inputAnswer" rows="1" class="p-0"></textarea>
        </div>
        <div class="col-1">
          <button type="button" class="btn btn-bg-blue" id="idBtnAnswer">Answer</button>

        </div>
      </div>
    </div>
  </div>
</div>