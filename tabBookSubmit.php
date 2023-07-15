<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    $book_id=$_POST["book_id"];
    $book_title=$_POST["book_title"];
    $book_type=$_POST["book_type"];
    $book_kind=$_POST["book_kind"];
    $book_number=$_POST["book_number"];
    $book_free_number=$_POST["book_free_number"];
    $book_add=$_POST["book_add"];
    $author_id=$_POST["author_id"];
    $variableCanUpdate=true;
    if ($book_add!=""){
        $book_add=(int)$book_add;
        if ($book_add>0){
            $book_number=(int)$book_number+$book_add;
            $book_free_number=(int)$book_free_number+$book_add;
        }else{
            $book_add=(int)$book_add*-1;
            if((int)$book_add>(int)$book_free_number  || (int)$book_add>(int)$book_number ){
                //variable needed to display the message
                $color="Yellow";
                $messVal="Substraction impossible!";
                $variableCanUpdate=false;
            }else{
                $book_number=(int)$book_number-(int)$book_add;
                $book_free_number=(int)$book_free_number-(int)$book_add;
            }
        }
    }


    if ($variableCanUpdate){
        //modification of the information concerning the book
        $valUpdateBook=[$book_title,$book_type,$book_kind,$book_number,$book_free_number,$book_id];
        $queryUpdateBook="update Book set book_title=?, book_type=?, book_kind=?, book_number=?, book_free_number=? where book_id=? ";
        addNewInformation($connection, $queryUpdateBook,$valUpdateBook);
        $color="green";
        $messVal="Modification done well!";
    }
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    require_once "formTabBookMore.php";
    listLoad($title,$form,$hrefReturn,$spanMess);
    
?>