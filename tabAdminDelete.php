<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //deleting
    $valDeleteAdmin=[$_SESSION['user_mail']];
    $queryDeleteAdmin="delete from admin where admin_mail=?";
    addNewInformation($connection,$queryDeleteAdmin,$valDeleteAdmin);
    
    //to disconnect
    require_once "disconnectLoad.php";

?>