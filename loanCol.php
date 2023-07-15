<?php
require_once "securing.php";
//this file allows to have all the loan records
require_once "db-connection.php";
require_once "queryFunction.php";
$col=showInformation($connection,"select * from loan order by loan_id asc",[]); //this variable contains the loan's (array)
?>