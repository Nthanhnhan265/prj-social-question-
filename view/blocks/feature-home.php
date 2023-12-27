<div id="idTrendingTags" class="ps-4 pt-2">
    <h6 class="d-flex"> <span class="material-symbols-outlined pe-2">sell</span>Trending tags</h6>
    <?php
    $i = 0;
    foreach ($tags as $tag) {
        $i++;
        echo ('<a href="hashtag.php?tag='.$tag['name'].'" class="badge badge-warning me-1 mb-1">' . $tag['name'] . '<span class="circleForCount">' . $tag['count'] . '</span></a>');
        if ($i == 5) {
            break;
        }
    } ?>
</div>
<div id="idRecentView" class="ps-4 pt-4 ">
    <h6 class="d-flex align-items-center">
        <span class="material-symbols-outlined pe-2">
            star
        </span> Tops

    </h6>
    <ul class="list-group">

        <?php
        if (!empty($top3questions)) {
            foreach ($top3questions as $top3Question) {

                echo ('<li class="d-flex list-group-item ps-1 mb-2 pe-2 text-blue"><span class="material-symbols-outlined">
            keyboard_arrow_right    
            </span><a class="text-decoration-none text-none-color" href="question.php?q='.$top3Question['id'].'">' . $top3Question['content'] . '</a></li>');
            }
        }
        ?>

    </ul>

</div>

<div id="idRecentView" class="ps-4 pt-4 ">
    <h6 class="d-flex align-items-center">
        <span class="material-symbols-outlined pe-2">
            history
        </span> Recent view

    </h6>
    <ul class='list-group'>
        <?php

        if(!empty($questionsRecentView)) { 
            $i=0; 
            foreach($questionsRecentView as $question) { 
                if(strlen($question['content'])>20) { 
                    echo('<li class="list-group-item pe-0"><a class="text-decoration-none text-none-color" href="question.php?q='.$question['id'].'">'.substr($question['content'],0,strpos($question['content'],' ',15)).'...</a></li>'); 
                    
                }else { 
                    // echo('<li class="list-group-item pe-0"><a class="text-decoration-none text-none-color" href="question.php?q='.$question['id'].'">'.$question['content'].'</a></li>'); 
                    
                }
                $i++; 
                if($i==10) { 
                    break; 
                }
            }
        }

        ?>
    </ul>
</div>