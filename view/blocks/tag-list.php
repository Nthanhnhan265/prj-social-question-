<h4 class='mt-2'>List of hashtags</h4>

<table class="mt-3 mb-2 idListUsers">
    <tr>
        <th class="px-1 bg-info text-white text-center">Action</th>
        <th class="px-3 bg-info text-white text-center">ID</th>
        <th class="px-1 bg-info text-white text-center">Hashtag</th>
    </tr>
    
    <?php
    foreach ($tags as $tag) {
        ?>
        <tr>
            <td class='text-center'>
                <a href="#" class="btn bg-danger mb-1 mt-1">
                    <span class="material-symbols-outlined">
                        delete
                    </span></a>
                <!-- <a href="#" class="btn bg-warning">
                

                </a>
         -->
            </td>
            <td class='px-1 text-center'>
                <?php echo ($tag['id_hashtag']); ?>
            </td>
            <td class='px-1 text-center' style="overflow-wrap:anywhere">
                <?php echo ($tag['name']); ?>
            </td>
        </tr>

    <?php } ?>

</table>

<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <!-- <a class="page-link">Previous</a> -->
    </li>
    <?php 
        for($i=0;$i<$numOfPage;$i++) {
            if($i==$page-1) {
                echo('<li class="page-item active"><a class="page-link" href="hashtag.php?page='.($i+1).'">'.($i+1).'</a></li>'); 
            } else { 
                
                echo('<li class="page-item"><a class="page-link" href="hashtag.php?page='.($i+1).'">'.($i+1).'</a></li>'); 
            }
        }
    
    ?>
        <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
    <li class="page-item">
      <!-- <a class="page-link" href="#">Next</a> -->
    </li>
  </ul>
</nav>