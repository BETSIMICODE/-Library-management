<?php
require_once "securing.php";
//charge listLoan in the first 
    require_once "listLoan.php";
    if ($col){
        //if record exists
        listLoan(0,$col,"");
    }
    else{
        //if not...
        require_once "listLoad.php";
        $title="No recording available...";
        $hrefReturn="loan.php";
        $form="";
        listLoad($title,$form,$hrefReturn,"");
    }
?>