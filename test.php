<?php
require_once "securing.php";
require_once "calculFunction.php";
    $return_date_search=$_GET['return_date_search'];
    echo convertDate($return_date_search);
?>