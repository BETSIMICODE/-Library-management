<?php
require_once "securing.php";
require_once "loanSubmit.php";

//call the file listLoan.php to refresh the page
    require_once "listLoan.php";
    //get the registration number
        for ($i=0; $i <count($col) ; $i++) { 
            if($col[$i]["loan_id"]==$loan_id){
                break;
            }
        }
    
    listLoan($i,$col,$spanMess);

?>