<?php
require_once "securing.php";
require_once "loanDelete.php";
//call the file listLoan.php to refresh the page
    require_once "listLoan.php";
    if ($col){
        //if record exists
        listLoan(0,$col,$spanMess);
    }
    else{
        //if not...
        require_once "listLoad.php";
        $title="No recording available...";
        $hrefReturn="loan.php";
        $form="";
        listLoad($title,$form,$hrefReturn,$spanMess);
    }

?>