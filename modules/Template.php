<?php 
class Template { 
    public function View($view,$data=[] ) { 
        extract($data); 
        include(BASE_PATH."../view/$view.php");
        
    }
    public function Render($view,$data=[]) { 
        ob_start(); 
        extract($data); 
        include(BASE_PATH."/view/blocks/$view.php");
        return ob_get_clean(); 
    }

}