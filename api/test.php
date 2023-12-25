<?php
require('../config/config.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


</head>

<body>
    <div id="toggle">
        <span class="material-symbols-outlined">
            toggle_off
        </span>
    </div>



    <script>
        const toggle = document.querySelector('#toggle');
        let flag = true
        toggle.addEventListener('click', () => {
            if (!flag) {
                toggle.innerHTML = `<span class="material-symbols-outlined">
        toggle_off
        </span>`
                flag = true;
            } else {
                toggle.innerHTML = ` <span class="material-symbols-outlined">
        toggle_on
        </span>`
                flag = false;
            }

        });

    </script>
</body>

</html>