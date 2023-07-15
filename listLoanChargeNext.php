<?php
    require_once "securing.php";
    $i=(int)$_POST["iValue"];
    
    require_once "listLoan.php";
    if ($i<count($col)-1){
        $i++;
    }else{
        $i=0;
    }
    listLoan($i,$col,"");
    
    
?>