<?php
require_once "securing.php";
require_once "loanCol.php";
function listLoan($i=0,$col,$mess){
    $valueCol=$col[$i];
    //call the file listLoanLoad who have the function addLoanLoad($mess)
    require_once "listLoanLoad.php";
    listLoanLoad($mess,$valueCol,$i);
}
?>