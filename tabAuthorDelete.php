<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //recuperation author author_id

    $author_id=$_POST["author_id"];
    $bookHaveSameAuthor=showInformation($connection,"select book_id from book where author_id=?",[$author_id]);
    foreach ($bookHaveSameAuthor as $value) {
        //deleting loan with this book...
        $queryDeleteLoan="delete from loan where book_id=?";
        addNewInformation($connection,$queryDeleteLoan,[$value["book_id"]]);
    }
    
    //deleting book
    $queryDeleteBook="delete from book where author_id=?";
    addNewInformation($connection,$queryDeleteBook,[$author_id]);

    //deleting author
    $queryDeleteAuthor="delete from author where author_id=?";
    addNewInformation($connection,$queryDeleteAuthor,[$author_id]);
    //redirequection
    require_once "tabAuthor.php";
    echo '<script> window.confirm("All the books written by the author are all deleted as well as the corresponding loans")</script>';

?>