<?php 
    include("../config/config.php"); 
    if(!empty($_GET['q'])) { 
        $q=$_GET['q']; 
        define("UPVOTE",1);
        define("FIRST_POS",0); 
        define("DOWNVOTE",0);
        $template=new Template(); 
        $questionModule=new Question(); 
        $userModule=new User(); 
        $voteModule=new Vote(); 
        $bookmarkModule=new Bookmark();
        $question=$questionModule->getQuestionByID($q); 
        $questions=[]; 
        if(!empty($question)) { 
            $questions=[0=>$question]; 
        } 
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
        if(!empty($_SESSION['username'])) { 
            $votedQuestions=$voteModule->getAllVotedQuestionsByUsername($_SESSION["username"]); 
            $markedQuestions=$bookmarkModule->getAllQuestionsMarked($_SESSION["username"]); 

        } 
        
        if(!empty($votedQuestions) && !empty('username') && count($votedQuestions)==2) { 
            if(!empty($votedQuestions[UPVOTE]["voted"])) { 
                $upVotedQuestions=$votedQuestions[UPVOTE]["voted"]; 
                // var_dump($upVotedQuestions); 
            }
            if (!empty($votedQuestions[DOWNVOTE]["voted"])){ 
                $downVotedQuestions=$votedQuestions[DOWNVOTE]["voted"]; 
                //var_dump($downVotedQuestions); 
            }
        }
        else if(!empty('username') &&!empty($votedQuestions) && count($votedQuestions)==1 && $votedQuestions[FIRST_POS]["type"]=='upvote') { 
            $upVotedQuestions=$votedQuestions[FIRST_POS]["voted"]; 
        }
        else if(!empty('username') &&!empty($votedQuestions)&& count($votedQuestions)==1 && $votedQuestions[FIRST_POS]["type"]=='downvote') { 
            $downVotedQuestions=$votedQuestions[FIRST_POS]["voted"]; 
        }
        $tags=$hashtagModule->getAllTagsIn24Hours();  
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
            "slot"=>$template->Render('feature-home',["tags"=>$tags,"top3questions"=>$top3Questions, 
            "questionsRecentView"=>$questionsRecentView,
            ]) , 
            "slot2"=>$template->Render("question",["questions"=>$questions,
            "userModule"=>$userModule,
            "upVotedQuestions"=>$upVotedQuestions,
            "downVotedQuestions"=>$downVotedQuestions,
            "markedQuestions"=>$markedQuestions,
            "tagsOfQuestions"=>$tagsOfQuestions,        
            "imagesList"=>$imagesList ,
            
            
            ]
            ) 
        ]; 
    
        $template->View("home",$data); 
    }else { 
      // header("location: http://localhost/prj-social-question/public/index.php"); 

}







?> 