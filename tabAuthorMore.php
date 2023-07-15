<?php
    require_once "securing.php";
    if(isset($_GET['author_book_id']) && !empty($_GET['author_book_id'])){
        //if page provid by book_list...
        //recuperation author_id book_id values 
            $author_book_id=explode(" ",$_GET["author_book_id"]);
            $author_id=$author_book_id[0];
            $book_id=$author_book_id[1];
            $AuthorDeleteBtn="";
            $hrefReturn="tabBook.php";
        // echo "author Id bien".$author_id."envoyé";
        // echo "book Id bien".$book_id."envoyé";
    }else{
        //if the page provid by author_list...
        $author_id=$_GET["author_id"];
        $book_id="";
        $AuthorDeleteBtn='
        <div class="submitLine">
            <input class="submitBtn" onclick="authorDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabAuthorDelete.php">
        </div>
        <script>
            function authorDelete() {
                if(confirm("Do you really went delete this author ,the book  and loan concerned?")){
                    document.getElementById("deleteBtn").setAttribute("formaction","tabAuthorDelete.php");    // sets the value of the "formaction" attribute of the form
                    document.getElementById("deleteBtn").submit();  // submits the form
                }else{event.preventDefault();}
                }
        </script>
        ';
        $hrefReturn="tabAuthor.php";
    }

    require_once "formTabAuthorMore.php";
    listLoad($title,$form,$hrefReturn,"");




        
?>
