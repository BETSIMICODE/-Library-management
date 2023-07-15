<?php
    require_once "securing.php";
    //recuperation admin_mail values
        $admin_mail= $_GET['admin_mail'];
        // echo $admin_mail;
    require_once "formTabAdminMore.php";
        listLoad($title,$form,$hrefReturn,"");




        
?>