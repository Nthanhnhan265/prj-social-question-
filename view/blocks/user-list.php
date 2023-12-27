<h4 class='mt-2'>List of users</h4>

<table class="mt-3 mb-2 idListUsers">
    <tr>
        <th class="px-3 bg-info text-white text-center">Action</th>
        <th class="px-1 bg-info text-white text-center">Username</th>
        <th class="px-1 bg-info text-white text-center">Last name</th>
        <th class="px-1 bg-info text-white text-center">First name</th>
        <th class="px-1 bg-info text-white text-center">Description</th>
        <th class="px-1 bg-info text-white text-center">Created at</th>
        <th class="px-1 bg-info text-white text-center">Password</th>
        <th class="px-1 bg-info text-white text-center">Avatar</th>
    </tr>
    
    <?php
    foreach ($users as $user) {
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
                <?php echo ($user['username']); ?>
            </td>
            <td class='px-1 text-center'>
                <?php echo ($user['lastname']); ?>
            </td>
            <td class='px-1 text-center'>
                <?php echo ($user['firstname']); ?>
            </td>
            <td class='px-1 text-center' style="overflow-wrap:anywhere">
                <?php echo ($user['description']); ?>
              
            </td>
            <td class='px-1 text-center'>
                <?php echo ($user['joined_at']); ?>
            </td>
            <td class='px-1 text-center' class='overflow-auto'>
                <?php
                echo (substr($user['password'], 0, 40));
                ?>...
            </td>
            <td class='px-1 text-center'>
                <?php echo ($user['avatar']); ?>
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
                echo('<li class="page-item active"><a class="page-link" href="admin.php?page='.($i+1).'">'.($i+1).'</a></li>'); 
            } else { 
                
                echo('<li class="page-item"><a class="page-link" href="admin.php?page='.($i+1).'">'.($i+1).'</a></li>'); 
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