<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
//recuperation author information
    $col=showInformation($connection,"select * from author where author_id=?",[$author_id]); //this variable contains the author's (array)
//file usefull for recording display
    require_once "listLoad.php";
    $valueCol=$col[0];
    $title="Author Information";
    // $hrefReturn="tabBook.php";
    $form=
    '
    <form  method="post">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="authorId">Id</label> 
                <input readonly="readonly" type="text" name="author_id" value= "'.$valueCol["author_id"].'" class="inputInfo" id="authorId" placeholder=" Author Id" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="authorNickName">Nick Name</label> 
                <input type="text"  name="author_nick_name" class="inputInfo" value= "'.$valueCol["author_nick_name"].'" id="authorNickName" placeholder="Nick Name">
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="authorName">Name</label> 
                <input  type="text" name="author_name" value= "'.$valueCol["author_name"].'" class="inputInfo" id="authorName" >
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="authorFName">First Name</label> 
            <input  type="text" name="author_f_name" value= "'.$valueCol["author_f_name"].'" class="inputInfo" id="authorFName" >
            </div>
        </div>
        <div class="notPrint">
            <div class="lineLeft">
                <input  type="text" name="book_id" value= "'.$book_id.'" class="inputInfo" id="bookId" >
            </div>
            
        </div>
        <div class="submitLine">
            <input class="submitBtn" type="submit" value="Modify" formaction="tabAuthorSubmit.php">
        </div>
        <div class="submitLine">
            <input class="submitBtn bookList" type="submit" value="Book List" formaction="tabAuthorBookList.php">
        </div>
        '.$AuthorDeleteBtn.'
    </form>
    ';

?>