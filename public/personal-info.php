<?php 
require('../config/config.php');
$template =new Template(); 
define("FIRST_POS",0); 
$userModule=new User();
$bookmarkModule=new Bookmark(); 
$questionModule=new Question(); 
$answerModule=new Answer();  
$answers=''; 
$questions=''; 
$bookmarks=''; 
$user='';
// $shares=''; 
$page='shared';
$imageModule=new Images();
$imagesList=$imageModule->getAllImages('question');
$voteModule=new Vote(); 
$hashtagModule=new HashTag(); 
$upVotedQuestions=''; 
$downVotedQuestions=''; 
$tagsOfQuestions=$hashtagModule->getAllTagsAndQuestions();
$markedQuestions=''; 
$votedQuestions=''; 
    if(!empty($_SESSION['username'])&& !empty($_GET['user']) && $_SESSION['username']==$_GET['user']){ 

        $user=$userModule->getUserByUsername($_SESSION['username']); 
        
        //Kiểm tra người dùng chọn page nào 
        if(!empty($_GET['page']) && $_GET['page']=='answered') { 
            $answers=($answerModule->getAllAnswersByUser($_SESSION['username']));
            $page='answered'; 
        }
        else if(!empty($_GET['page']) && $_GET['page']=='asked') { 
            $answers=($answerModule->getAllAnswersByUser($_SESSION['username']));
            $page='asked'; 
            $questions=$questionModule->getQuestionsByUser($_SESSION['username']);
        }
        else if(!empty($_GET['page']) && $_GET['page']=='marked') { 
            $bookmarks=($bookmarkModule->getAllBookmarkByUsername($_SESSION['username']));
            $questions=$bookmarkModule->getAllMarkedQuestions($_SESSION['username']); 
            $page='marked'; 
            
        }
        else { 
            header("location: http://localhost/prj-social-question-/public/personal-info.php?page=answered");
        }
        
        //Kiểm tra user đã đăng nhập chưa để load các vote
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
    }
    //khi người dùng chưa đăng nhập hoặc không phải là chủ của tài khoản thì xem với vai trò khách
    else{ 
        if(!empty($_GET['user'])) { 
            $user=$userModule->getUserByUsername($_GET['user']); 
            $username=$user['username'];
            //Kiểm tra người dùng chọn page nào 
            if(!empty($_GET['page']) && $_GET['page']=='answered') { 
                $answers=($answerModule->getAllAnswersByUser($username));
                $page='answered'; 
            }
            else if(!empty($_GET['page']) && $_GET['page']=='asked') { 
                $answers=($answerModule->getAllAnswersByUser($username));
                $page='asked'; 
                $questions=$questionModule->getQuestionsByUser($username);
            }
            else if(!empty($_GET['page']) && $_GET['page']=='marked') { 
                $bookmarks=($bookmarkModule->getAllBookmarkByUsername($username));
                $questions=$bookmarkModule->getAllMarkedQuestions($username); 
                $page='marked'; 
                
            }
            else { 
                if(!empty($_GET['user'])) { 
                    header("location: http://localhost/prj-social-question-/public/personal-info.php?user=".$user['username']."&page=answered");
                    
                }else { 
                    header("location: http://localhost/prj-social-question-/public/index.php");

                }
            
            }
            
            //Kiểm tra user đã đăng nhập chưa để load các vote
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
        }  else { 
            header("location: http://localhost/prj-social-question-/public/index.php");

        }
    
    }


$data=[ 
    "title"=>"Home", 
    "slot"=>"" , 
    "slot2"=>$template->Render("personal-page",
    ["user"=>$user,
    "answers"=>$answers,
    "questions"=>$questions, 
    "bookmarks"=>$bookmarks, 
    "page"=>$page
    ,"userModule"=>$userModule,
    "upVotedQuestions"=>$upVotedQuestions,
    "downVotedQuestions"=>$downVotedQuestions,
    "markedQuestions"=>$markedQuestions,
    "tagsOfQuestions"=>$tagsOfQuestions,        
    "imagesList"=>$imagesList,
    
    
    
    
    ])
]; 

$template->View("home",$data);