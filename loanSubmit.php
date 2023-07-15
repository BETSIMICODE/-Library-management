<?php
//this file has the code that allows to modify the loan information
require_once "securing.php";
try {
    //recuperation information loan's values
        $loan_id=$_POST["loan_id"];
        $penalty_cost=(int)$_POST["penalty_cost"];
        $return_date=$_POST["return_date"];
        $loan_date= $_POST["loan_date"];
        $book_id= $_POST["book_id"];
        $member_id= $_POST["member_id"];
    //file required for database manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    $valBool=true;
    //penalty cost modification...
        if ($penalty_cost==0 &&  $return_date!=""){
            //recuperation book_penalty values...
            $BookPenaltyVal=$book_id;
            $queryBookPenaltyRecup="select book_penalty from book where book_id=?";
            $book_penalty=(int)recupVal($connection,$queryBookPenaltyRecup,$BookPenaltyVal,"book_penalty");
            //calcul penalty cost
            require_once "calculFunction.php";
            $diff_date=diffDate($loan_date,$return_date);
            // echo strVal($diff_date)."   ";
            $penalty_cost=(int)$diff_date*$book_penalty;
            // echo strVal($penalty_cost);
        }

    // //recuperation of id_loan...
        
    //     $idRecupVal=[$loan_date,$book_id,$member_id];
    //     $queryIdRecup="select loan_id from loan where loan_date=? and book_id=? and member_id=?";
    //     $loan_id=recupVal($connection,$queryIdRecup,$idRecupVal,"loan_id");
    
    //recuperation return_date values  in database
        $queryReturnDateDbRecup="select return_date from loan where loan_id=?";
        $ReturnDateDbRecupVal=[$loan_id];
        $return_date_db=recupVal($connection,$queryReturnDateDbRecup,$ReturnDateDbRecupVal,"return_date");

    //update loan information
        if ($return_date==""){
            //when the return_date in database is also None
                if($return_date_db==""){
                    // echo "Return date is none";
                    //Nothing to do
                    $valBool=false;
                }else{
                    #if the return date is not empty in the database then the book is already returned but here we are going to modify the date as empty so we must resubtract the number of free books
                        //book free number recuperation
                            $queryBookAvailablity="select * from book where book_id=?";
                            $queryValBookAvailablity=[$book_id];
                            $book_free_number="book_free_number";
                            $book_free_number_val=(int)recupVal($connection,$queryBookAvailablity,$queryValBookAvailablity,$book_free_number);
                        //Substract the number of free books 
                            if ($book_free_number_val>0){
                                $book_free_number_new=$book_free_number_val-1;
                                $val_query_modify_bookFN=[$book_free_number_new,$book_id];
                                $query_modify_bookFN="update book set book_free_number=? where book_id=?";
                                addNewInformation($connection,$query_modify_bookFN,$val_query_modify_bookFN);
                            }
                        //variable usefull for update loan information
                            $return_date=NULL;
                            $valUpdateLoan=[$return_date,$loan_id];
                            $queryUpdateLoan="update loan set return_date=? where loan_id=?";
                }     
        }else if ($return_date!=""  && $return_date_db==""){
            //book free number recuperation
                $queryBookAvailablity="select * from book where book_id=?";
                $queryValBookAvailablity=[$book_id];
                $book_free_number="book_free_number";
                $book_free_number_val=(int)recupVal($connection,$queryBookAvailablity,$queryValBookAvailablity,$book_free_number);
            
            //book number recuperation
                $queryBookAvailablity="select * from book where book_id=?";
                $queryValBookAvailablity=[$book_id];
                $book_number_txt="book_number";
                $book_number=(int)recupVal($connection,$queryBookAvailablity,$queryValBookAvailablity,$book_number_txt);
            
            //add the number of free books
                if($book_number>$book_free_number_val){
                    $book_free_number_new=$book_free_number_val+1;
                    $val_query_modify_bookFN=[$book_free_number_new,$book_id];
                    $query_modify_bookFN="update book set book_free_number=? where book_id=?";
                    addNewInformation($connection,$query_modify_bookFN,$val_query_modify_bookFN);
                }
            //variable usefull for update loan information
                // $valUpdateLoan=[$return_date,$penalty_cost,$loan_id];
                $valUpdateLoan=[$return_date,$loan_id];
                // $queryUpdateLoan="update loan set return_date=?, penalty_cost=?  where loan_id=?";
                $queryUpdateLoan="update loan set return_date=? where loan_id=?";
        }else{
            //variable usefull for update loan information
                $valUpdateLoan=[$penalty_cost,$return_date,$loan_id];
                $queryUpdateLoan="update loan set penalty_cost=?, return_date=?  where loan_id=?";
        }
    //Add the new loan information to the databases
        if($valBool){
            addNewInformation($connection,$queryUpdateLoan,$valUpdateLoan);
            $color="green";
            $messVal="Loan information is modified successfully  ";
        }else{
            $color="yellow";
            $messVal="No information modified  ";
        }
        
} catch (Exception $th) {
    $color="red";
    $messVal="An error occurred while modification!!!";
}
//variable needed to display the message
$spanMess="<span style='color:".$color."'>".$messVal."</span>";


?>