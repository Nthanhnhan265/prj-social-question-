<?php 
    require("../config/config.php"); 
    define("DOWNVOTE",0);
    define("UPVOTE",1);
    define("FIRST_POS",0); 
    $template=new Template(); 
    $questionModule=new Question(); 
    $userModule=new User(); 
    $voteModule=new Vote(); 
    $bookmarkModule=new Bookmark(); 
    $questions=$questionModule->getAllQuestions(); 
    $hashtagModule=new HashTag(); 
    $imageModule=new Images(); 
    $top3Questions=$questionModule->getTopQuestions(); 
    $imagesList=$imageModule->getAllImages('question');
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
    else if(!empty($votedQuestions) &&count($votedQuestions)==1 && $votedQuestions[FIRST_POS]["type"]=='downvote') { 
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
    
    $tags=$hashtagModule->getAllTagsIn24Hours();  
    $data=[ 
        "title"=>"Home", 
        "slot"=>$template->Render('feature-home',["tags"=>$tags,
            "top3questions"=>$top3Questions, 
            "questionsRecentView"=>$questionsRecentView,
            
            
            ]) , 
        "slot2"=>$template->Render("question",["questions"=>$questions,
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

    ?>