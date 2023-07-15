<?php
    require_once "securing.php";
    $i=(int)$_POST["iValue"];
    require_once "listLoan.php";
    if($i>0){
        $i--;}else{
            $i=count($col)-1;
        };

    listLoan($i,$col,"");
?>