<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //recuperation member_id
    $member_id=$_POST["member_id"];
    //deleting loan with this member...
    $queryDeleteLoan="delete from loan where member_id=?";
    addNewInformation($connection,$queryDeleteLoan,[$member_id]);
    //deleting member
    $queryDeletemember="delete from member where member_id=?";
    addNewInformation($connection,$queryDeletemember,[$member_id]);
    
    //redirequection
    require_once "tabMember.php";

?>