<?php
require_once "securing.php";
    function addLoad($title,$form,$hrefReturn,$mess){
        //function who call the addForm.php (add's genarally form)
        $mess=$mess;
        $title=$title;
        $form=$form;
        $hrefReturn=$hrefReturn;
        require_once "addForm.php";

    }
?>