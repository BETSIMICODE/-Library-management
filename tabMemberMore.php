<?php
    require_once "securing.php";
    //recuperation member_id values
        $member_id= $_GET['member_id'];
        // echo $member_id;
    require_once "formTabMemberMore.php";
        listLoad($title,$form,$hrefReturn,"");




        
?>