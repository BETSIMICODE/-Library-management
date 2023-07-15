<?php
require_once "securing.php";
function addBookLoad($mess){
        //this function specify the add load with title, the button return , and the form...
    require_once "addLoad.php";
    $title="Add new book";
    $hrefReturn="book.php";
    $form=
    '<form method="post" action="addBookSubmit.php" >
    <div class="addFormLine" id="addFormLine1">
        <div class="lineLeft">
            <label class="labelTxt" for="book_title">Title</label> 
            <input type="text" name="book_title" class="inputInfo" id="book_title" placeholder="Title">

        </div>
        <div class="lineRight">
            <label class="labelTxt" for="book_kind">Kind</label> 
            <input type="text" name="book_kind" class="inputInfo" id="book_kind" placeholder="Kind">
        </div>
    </div>
    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="book_type">Type</label> 
            <input type="text" class="inputInfo" name="book_type" id="book_type" placeholder="Type">
        </div>
        <div class="lineRight">
            <label class="labelTxt"  for="book_Number">Number</label> 
            <input type="number" class="inputInfo" name="book_number" min="1" id="book_number" placeholder="Total Number">
        </div>
    </div>
    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="authorNickName">Nick name</label> 
            <input type="text" class="inputInfo" name="author_nick_name" id="authorNickName" placeholder="Author nick name">

        </div>
        <div class="lineRight">
            <label class="labelTxt" for="book_penalty">Penalty</label> 
            <input type="number" class="inputInfo" min="0" name="book_penalty" id="book_penalty" placeholder="Daily fine (Ariary)">
        </div>
    </div>

    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="authorName">Name</label> 
            <input type="text" class="inputInfo" name="author_name" id="authorName" placeholder="Author Name">

        </div>
        <div class="lineRight">
            <label class="labelTxt" for="authorFName">First names</label> 
            <input type="text" class="inputInfo" name="author_f_name" id="authorFName" placeholder="Author First names">
        </div>
    </div>

    <div class="submitLine">
        <input class="submitBtn" type="submit" value="SUBMIT">
    </div>



</form>';
    addLoad($title,$form,$hrefReturn,$mess);

}

?>