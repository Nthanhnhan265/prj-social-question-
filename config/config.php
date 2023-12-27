<?php
DEFINE("DB_LOCALHOST","localhost"); 
DEFINE("DB_USER","root"); 
DEFINE("DB_PASS",""); 
DEFINE("DB_NAME","webhoidap"); 
DEFINE("BASE_PATH",$_SERVER['DOCUMENT_ROOT']."/prj-social-question-"); 

session_start();
spl_autoload_register(function($className) { 
        require(BASE_PATH."/modules/$className.php"); 
}); 