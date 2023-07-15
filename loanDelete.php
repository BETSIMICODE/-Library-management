<?php
//this file has the code that removes the loan information
    require_once "securing.php";
    try {
        //recuperation information loan's values
            $penalty_cost=(int)$_POST["penalty_cost"];
            $return_date=$_POST["return_date"];
            $loan_date= $_POST["loan_date"];
            $book_id= $_POST["book_id"];
            $member_id= $_POST["member_id"];
        //file required for database manipulation
            require_once "db-connection.php";
            require_once "queryFunction.php";
        //recuperation of id_loan...
            $idRecupVal=[$loan_date,$book_id,$member_id];
            $queryIdRecup="select loan_id from loan where loan_date=? and book_id=? and member_id=?";
            $loan_id=recupVal($connection,$queryIdRecup,$idRecupVal,"loan_id");
        //erased recording
            //recuperation return_date values  in database
                $queryReturnDateDbRecup="select return_date from loan where loan_id=?";
                $ReturnDateDbRecupVal=[$loan_id];
                $return_date_db=recupVal($connection,$queryReturnDateDbRecup,$ReturnDateDbRecupVal,"return_date");
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
                    
                if(($return_date_db=="")&&($book_number>$book_free_number_val)){
                    //add +1 the book_free
                    $book_free_number_new=$book_free_number_val+1;
                    $val_query_modify_bookFN=[$book_free_number_new,$book_id];
                    $query_modify_bookFN="update book set book_free_number=? where book_id=?";
                    addNewInformation($connection,$query_modify_bookFN,$val_query_modify_bookFN);
                }
            //deleting
            $valUpdateLoan=[$loan_id];
            $queryUpdateLoan="delete from loan where loan_id=?";
            addNewInformation($connection,$queryUpdateLoan,$valUpdateLoan);
    
            //message 
            $color="green";
            $messVal="Loan successfully deleted";
        
    } catch (Exception $th) {
        $color="red";
        $messVal="An error occurred while deleting!!!";
    }
    //variable needed to display the message
        $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    
    
?>