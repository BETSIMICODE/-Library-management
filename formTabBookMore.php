<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
//recuperation book information
    $col=showInformation($connection,"select * from book where book_id=?",[$book_id]); //this variable contains the book's (array)
//file usefull for recording display
    require_once "listLoad.php";
    $valueCol=$col[0];
    $title="Book Information";
    $hrefReturn="tabBook.php";
    $form=
    '
    <form  method="post">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="bookId">Id</label> 
                <input readonly="readonly" type="text" name="book_id" value= "'.$valueCol["book_id"].'" class="inputInfo" id="bookId" placeholder="ID" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="bookTitle">Title</label> 
                <input type="text"  size="30" name="book_title" class="inputInfo" value= "'.$valueCol["book_title"].'" id="bookTitle" placeholder="Title">
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="bookKind">Kind</label> 
                <input  type="text" name="book_kind" value= "'.$valueCol["book_kind"].'" class="inputInfo" id="bookKind"  placeholder="Kind">
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="bookType">Type</label> 
            <input  type="text" name="book_type" value= "'.$valueCol["book_type"].'" class="inputInfo" id="bookType" >
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="bookNumber">Number</label> 
                <input  readonly="readonly" type="number" name="book_number" value= '.$valueCol["book_number"].' class="inputInfo" id="bookNumber"  placeholder="Number">
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="bookFreeNumber">Free Number</label> 
            <input  readonly="readonly" type="number" name="book_free_number" value= '.$valueCol["book_free_number"].' class="inputInfo" id="bookFreeNumber" >
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="bookAdd">Add Book</label> 
                <input  type="number" name="book_add"  class="inputInfo" id="bookAdd"  placeholder="Add/substract">
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="authorId">Author ID</label> 
            <input  readonly="readonly" type="text" name="author_id" value= "'.$valueCol["author_id"].'" class="inputInfo" id="authorId" >
            <button class="btnMore btnMoreClick" data-ident="'.$valueCol["author_id"].' '.$valueCol["book_id"].'">  More </button>
            </div>
        </div>
        <div class="submitLine">
            <input class="submitBtn" type="submit" value="Modify" formaction="tabBookSubmit.php">
        </div>
        <div class="submitLine">
            <input class="submitBtn" onclick="loanDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabBookDelete.php">
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll(\'.btnMoreClick\').forEach(btn => {
            btn.addEventListener(\'click\', event => {
                const authorBookId = event.target.getAttribute(\'data-ident\');
                const xhr = new XMLHttpRequest();
                xhr.open(\'GET\', "tabAuthorMore.php?author_book_id=${authorBookId}");
                xhr.send();
                window.open(\'tabAuthorMore.php?author_book_id=\' + authorBookId);
                window.close();
            });
        });
    </script>
    <script>
        function loanDelete() {
            if(confirm("Do you really went delete this registre and the loan concerned?")){
                document.getElementById("deleteBtn").setAttribute("formaction","tabBookDelete.php");    // sets the value of the "formaction" attribute of the form
                document.getElementById("deleteBtn").submit();  // submits the form
            }else{event.preventDefault();}
            }
    </script>




    ';

?>