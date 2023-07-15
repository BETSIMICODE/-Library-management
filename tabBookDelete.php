<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //recuperation book_id
    $book_id=$_POST["book_id"];
    //deleting loan with this book...
    $queryDeleteLoan="delete from loan where book_id=?";
    addNewInformation($connection,$queryDeleteLoan,[$book_id]);
    //deleting book
    $queryDeleteBook="delete from book where book_id=?";
    addNewInformation($connection,$queryDeleteBook,[$book_id]);
    
    //redirequection
    require_once "tabBook.php";
    echo '<script>window.confirm("Book and corresponding loan well delete!")</script>';

?>