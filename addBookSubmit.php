<?php
require_once "securing.php";
// when we submit the new book this file is calling...

try {
    //code...
    //recuperation add new book's values
    $book_title= $_POST["book_title"];
    $book_type= $_POST["book_type"];
    $book_kind= $_POST["book_kind"];
    $book_number= $_POST["book_number"];
    $book_free_number= $book_number;
    $book_penalty= $_POST["book_penalty"];
    $author_name= $_POST["author_name"];
    $author_f_name= $_POST["author_f_name"];
    $author_nick_name= $_POST["author_nick_name"];

    //call file queryFunction.php and db-connection.php
    require_once "queryFunction.php";
    require_once "db-connection.php";
    
    //verification book existence
    $queryVerBook="select * from book where book_title=? and book_kind=? and book_type=?";
    $valQueryVerBook=[$book_title,$book_kind,$book_type];
    if(verification($connection,$queryVerBook,$valQueryVerBook)){
        $bookExist=true;
    }else{
        $bookExist=false;
        
    }
    
    
    
    //verification author existence
    $valQueryAuthor=[];
    $whereTabAuthor=[];
        if ($author_name!=""){
            array_push($valQueryAuthor,$author_name);
            array_push($whereTabAuthor,"author_name=?");
        }
        if ($author_f_name!=""){
            array_push($valQueryAuthor,$author_f_name);
            array_push($whereTabAuthor,"author_f_name=?");
        }
        if ($author_nick_name!=""){
            array_push($valQueryAuthor,$author_nick_name);
            array_push($whereTabAuthor,"author_nick_name=?");
        }
    $whereTabAuthorString=implode(' and ', $whereTabAuthor);
    $queryVerAuthor="select * from author where ".$whereTabAuthorString;
    if (verification($connection,$queryVerAuthor,$valQueryAuthor)){
        $authorExist=true;
    }else{
        $authorExist=false;
        //add new author 
        $queryAddAuthor="insert into author(author_name, author_f_name, author_nick_name) values (?,?,?)";
        addNewInformation($connection,$queryAddAuthor,[$author_name,$author_f_name,$author_nick_name]);
    }
    
    if ($authorExist==false || $bookExist==false){
        //recuperation id author
        $valRecup="author_id";
        $author_id=recupVal($connection,$queryVerAuthor,$valQueryAuthor,$valRecup);
    
    
        $valQueryAddBook=[$book_title,$book_kind,$book_type,$book_number,$book_free_number,$book_penalty,$author_id];
    
        //add new book
        $queryAddBook="insert into book(book_title, book_kind, book_type, book_number, book_free_number, book_penalty, author_id) values (?,?,?,?,?,?,?)";
        addNewInformation($connection,$queryAddBook,$valQueryAddBook);
        
        //message and color to print in the form
            //recuperation book Id...
            $book_id=recupVal($connection,"select book_id from book where book_title=? and book_type=? and book_kind=? and book_number=?",[$book_title,$book_type,$book_kind,$book_number],"book_id");
            $messVal="Book successfully added, book Id=".$book_id;
            $color="green";
    }else{
        $color="Yellow";
        $messVal="Book already exists!";
    }
} catch (Exception $th) {
    $color="red";
    $messVal="Wrong or incomplete information, please verify and try again!!";
}



//call the file addBookLoad who have the function addBookLoad($mess)
require_once "addBookLoad.php";
$spanMess="<span style='color:".$color."'>".$messVal."</span>";
addBookLoad($spanMess);
//script who print the add message 
// echo "<script> alert('".$messVal."');</script>";
?>