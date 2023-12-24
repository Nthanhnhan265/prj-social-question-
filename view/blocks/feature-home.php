<div id="idTrendingTags" class="ps-4 pt-2">
    <h6 class="d-flex"> <span class="material-symbols-outlined pe-2">sell</span>Trending tags</h6>
    <?php
    $i = 0;
    foreach ($tags as $tag) {
        $i++;
        echo ('<a href="#" class="badge badge-warning me-1 mb-1">' . $tag['name'] . '<span class="circleForCount">' . $tag['count'] . '</span></a>');
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
</div>

<div id="idRecentView" class="ps-4 pt-4 ">
    <h6 class="d-flex align-items-center">
        <span class="material-symbols-outlined pe-2">
            history
        </span> Recent view

    </h6>
</div>