<?php
    require_once "securing.php";
    //recuperation book_id values
    $book_id=$_GET["book_id"];
    // echo "book id=".$book_id." bien réçu";
    require_once "formTabBookMore.php";
        listLoad($title,$form,$hrefReturn,"");

    

?>