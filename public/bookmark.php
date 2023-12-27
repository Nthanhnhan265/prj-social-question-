<?php 
    include("../config/config.php"); 
    define("DOWNVOTE",0);
    define("UPVOTE",1);
    define("FIRST_POS",0); 
    $template=new Template(); 
    $bookMarkModule=new Bookmark(); 
    $questionModule=new Question();
    $questions=[]; 
    if(!empty($_SESSION['username'])) { 
        $questions=$bookMarkModule->getAllMarkedQuestions($_SESSION['username']); 
    }
    $imageModule=new Images();
    $imagesList=$imageModule->getAllImages('question');


    $userModule=new User(); 
    $template=new Template(); 
    $userModule=new User(); 
    $voteModule=new Vote(); 
    $bookmarkModule=new Bookmark(); 
    $hashtagModule=new HashTag(); 
    
    $tagsOfQuestions=$hashtagModule->getAllTagsAndQuestions();
    $upVotedQuestions=''; 
    $downVotedQuestions=''; 
    $votedQuestions; 
    $markedQuestions=[]; 
    //Chưa Ràng buộc đăng nhập 
    if(!empty($_SESSION['username']) ) {
        $votedQuestions=$voteModule->getAllVotedQuestionsByUsername($_SESSION["username"]); 
        $markedQuestions=$bookmarkModule->getAllQuestionsMarked($_SESSION["username"]); 

    }


    if(!empty($votedQuestions) && count($votedQuestions)==2) { 
        if(!empty($votedQuestions[UPVOTE]["voted"])) { 
            $upVotedQuestions=$votedQuestions[UPVOTE]["voted"]; 
            // var_dump($upVotedQuestions); 
        }
        if (!empty($votedQuestions[DOWNVOTE]["voted"])){ 
            $downVotedQuestions=$votedQuestions[DOWNVOTE]["voted"]; 
            //var_dump($downVotedQuestions); 
        }
    }
    else if(!empty($votedQuestions) && count($votedQuestions)==1 && $votedQuestions[FIRST_POS]["type"]=='upvote') { 
        $upVotedQuestions=$votedQuestions[FIRST_POS]["voted"]; 
    }
    else if(!empty($votedQuestions) && count($votedQuestions)==1 && $votedQuestions[FIRST_POS]["type"]=='downvote') { 
        $downVotedQuestions=$votedQuestions[FIRST_POS]["voted"]; 
    }
    $questionsRecentView='';
    // var_dump($_COOKIE['recentIDs']); 
    //recent questions
    if(!empty($_COOKIE['recentIDs'])) { 
        $recentIDs=unserialize($_COOKIE['recentIDs']);
        if(count($recentIDs)>0) { 
            $questionsRecentView=$questionModule->getQuestionsRecentView($recentIDs); 
        } 
    }


    $data=[ 
        "title"=>"Home", 
        "slot"=>"This is feature", 
        "slot2"=>$template->Render("question",
            ["questions"=>$questions,
            "userModule"=>$userModule,
            "upVotedQuestions"=>$upVotedQuestions,
            "downVotedQuestions"=>$downVotedQuestions,
            "markedQuestions"=>$markedQuestions,
            "tagsOfQuestions"=>$tagsOfQuestions,        
            "imagesList"=>$imagesList, 
            ]
        ) 
    ]; 

    $template->View("home",$data); 