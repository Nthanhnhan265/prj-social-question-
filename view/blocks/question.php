
<!-- ấn để mở câu nơi chọn câu hỏi --> 
<div class="newQuestion">
  <div class="container">
    <div class="row">
      <div class="col-sm-1 avatarQuesion">img</div>
      <div class="col-sm-11 btn-bg-gray py-1" id="addQuestion" data-bs-toggle="modal" data-bs-target="#addQuestion">Have a question? Ask now . . .</div>
    </div>
  </div>

</div>

<?php foreach($questions as $question) { ?> 

<div class="questionBlock mb-2"> 
  <div class="row infoQuestion mb-3">
    <!-- phần avartar -->
    <div class="col-1">
      <div class="avatarQuestion"></div>
      
    </div>  
    <!-- phần họ tên -->
    <div class="col-10">
      <div class="authorQuestion"><?php 
      $user=$userModule->getUserByUsername($question["author"]);       
      echo(ucwords($user["lastname"]." ".$user["firstname"])); 
  
      
      ?></div>
      <div class="dateQuestion"><?php
      $date =date_create($question["created_at"]); 
      echo(date_format($date,"d/m/Y")); ?></div>

    </div>
    <!-- phần nút like, share -->
    <div class="col-1">
      <i class="fa fa-share text-none-color" aria-hidden="true"></i>
      <i class="fa fa-bookmark-o text-none-color" aria-hidden="true"></i>
    </div>
  </div>
  <!-- <div class="headingQuestion"><h4>heading</h4></div> -->
  <div class="contentQuestion"> <b> 
  <?php 
    echo($question["content"]); 
  ?>
  </b>
  </div>
  <div class="imgsQuestion">
    <!-- IMGs -->
  </div>
  <div class="featureQuestion mt-4">
    <button class="btn btn-outline-purple py-1">
      <i class="fa fa-angle-up text-purple" aria-hidden="true"></i>
      Upvote</button>
    <button class="btn btn-outline-purple py-1"> 
      <i class="fa fa-angle-down text-purple " aria-hidden="true"></i>
      Downvote</button>
    <button class="btn btn-outline-blue mx-1 py-1" data-bs-toggle="modal" data-bs-target="#showAnswer">
      <i class="fa fa-comments text-blue" aria-hidden="true"></i>
      Answer</button>
  </div>
</div>

<div class="modal fade" id="showAnswer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tiêu đề</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="overflow-">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, facilis laborum corrupti fuga provident quisquam cum impedit porro eius nostrum! Iure, impedit vero atque soluta necessitatibus obcaecati molestiae eum ipsam?
          </div>
        </div>
        <div class="modal-footer">
         <textarea name="yourAnswer" id="yourAnswer" rows="1"></textarea>
         <button type="button" class="btn btn-bg-blue">Answer</button>
        </div>
      </div>
    </div> 
</div> 

<?php } ?> 