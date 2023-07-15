<?php
require_once "securing.php";
// when we submit the new loan this file is calling...

    try {
        //code...
        //recuperation add new loan's values
        $loan_date= $_POST["loan_date"];
        $book_id= $_POST["book_id"];
        $member_id= $_POST["member_id"];

        if($loan_date=="" || $book_id=="" || $member_id==""){
            $color="red";
            $messVal="Incomplete information, please verify and try again!!";
        }else{
            //call file queryFunction.php and db-connection.php
            require_once "queryFunction.php";
            require_once "db-connection.php";
            //if the member dont'exists
            if (verification($connection,"select * from member where member_id=?",[$member_id])){
                //if member_exists
                // variable useful for verification book's availablity
                $queryBookAvailablity="select * from book where book_id=?";
                $queryValBookAvailablity=[$book_id];
                $book_free_number="book_free_number";
                $book_free_number_val=(int)recupVal($connection,$queryBookAvailablity,$queryValBookAvailablity,$book_free_number);
                // variable useful for verification if  member has not yet returned the book
                $queryBookYet="select * from loan where member_id=? and return_date is null";
                $valQueryBookYet=[$member_id];
                if(verification($connection,$queryBookYet,$valQueryBookYet)){
                    //verification if  member has not yet returned the book
                    //book not yet delivered
                    $book_not_delivered=recupVal($connection,$queryBookYet,$valQueryBookYet,"book_id");
                    //message and color to print in the form
                    $color="Yellow";
                    $messVal="The member has not yet returned the book id= ".$book_not_delivered;
                }else if ($book_free_number_val==0 || $book_free_number_val=="0"){
                    //message and color to print in the form
                    $color="purple";
                    $messVal="Book unavailable!!";
                }else{
                    //add new loan
                    $valQueryAddLoan=[$loan_date,$book_id,$member_id];
                    $queryAddLoan="insert into loan(loan_date, book_id, member_id) values (?,?,?)";
                    addNewInformation($connection,$queryAddLoan,$valQueryAddLoan);
                    
                    //modify the book number free
                    $book_free_number_new=$book_free_number_val-1;
                    $val_query_modify_bookFN=[$book_free_number_new,$book_id];
                    $query_modify_bookFN="update book set book_free_number=? where book_id=?";
                    addNewInformation($connection,$query_modify_bookFN,$val_query_modify_bookFN);
                    
                    
                    //message and color to print in the form
                        //recuperation loan_id...
                        $loan_id=recupVal($connection,"select loan_id from loan where loan_date=? and member_id=? and book_id=?",[$loan_date,$member_id,$book_id],"loan_id");
                        $messVal="Well-registered loan, loan-Id= ".$loan_id;
                        $color="green";
                }
                
            }else{
                $messVal="Member don't exists";
                $color="yellow";
            }

        }

    } catch (Exception $th) {
        $color="red";
        $messVal="Incomplete information, please verify and try again!!";
    }



    //call the file addLoanLoad.php who have the function addAdminLoad($mess)
    require_once "addLoanLoad.php";
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    addLoanLoad($spanMess);
    //script who print the add message 
    // echo "<script> alert('".$messVal."');</script>";
?>