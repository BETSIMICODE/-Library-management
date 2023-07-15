<?php
    require_once "securing.php";
    
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    require_once "tabFormLoad.php";


    //Checking if the search form has been submitted
    if ((isset($_GET['book_id_search']) && !empty($_GET['book_id_search'])) ||(isset($_GET['book_title_search']) && !empty($_GET['book_title_search'])) || (isset($_GET['book_kind_search']) && !empty($_GET['book_kind_search'])) || (isset($_GET['book_type_search']) && !empty($_GET['book_type_search'])) || (isset($_GET['book_number_search']) && !empty($_GET['book_number_search'])) || (isset($_GET['book_free_number_search']) && !empty($_GET['book_free_number_search']))  || (isset($_GET['author_id']) && !empty($_GET['author_id'])) || (isset($_GET['book_id']) && !empty($_GET['book_id']))){
        //if it is submitted...
        $author_id=$_GET["author_id"];
        $book_id=$_GET["book_id"];
        $book_id_search=$_GET['book_id_search'];
        $book_title_search=$_GET['book_title_search'];
        $book_type_search=$_GET['book_type_search'];
        $book_kind_search=$_GET['book_kind_search'];
        $book_number_search=$_GET['book_number_search'];
        $book_free_number_search=$_GET['book_free_number_search'];

        $valTabBook=[];
        $whereTabBook=[];
        if ($book_id_search!=""){
            array_push($valTabBook,$book_id_search);
            array_push($whereTabBook,"book_id=?");
        }
        if ($book_title_search!=""){
            array_push($valTabBook,$book_title_search);
            array_push($whereTabBook,"book_title=?");
        }
        if ($book_type_search!=""){
            array_push($valTabBook,$book_type_search);
            array_push($whereTabBook,"book_type=?");
        }
        if ($book_kind_search!=""){
            array_push($valTabBook,$book_kind_search);
            array_push($whereTabBook,"book_kind=?");
        }
        if ($book_number_search!=""){
            array_push($valTabBook,$book_number_search);
            array_push($whereTabBook,"book_number=?");
        }
        if ($book_free_number_search!=""){
            array_push($valTabBook,$book_free_number_search);
            array_push($whereTabBook,"book_free_number=?");
        }
        
        $whereTabBookString=implode(' and ', $whereTabBook);
        $queryTabBook="select book_id, book_title, book_type, book_kind, book_number, book_free_number, author_id from book where ".$whereTabBookString." and author_id=".$author_id." order by book_id asc";
        $col=showInformation($connection,$queryTabBook,$valTabBook);

    }else{
        //if not...
        $author_id=$_POST["author_id"];
        $book_id=$_POST["book_id"];
        $queryTabBook="select book_id,book_title,book_type,book_kind,book_number,book_free_number, author_id from book where author_id=".$author_id." order by book_id asc";
        $col=showInformation($connection,$queryTabBook,[]);
        
    }
    
    
    $stub=["Id","Title","Type","Kind","Number","Free-number"];
    $title="Book information";
    //Message
        if(count($col)==0){
            $color="yellow";
            $messVal="No registration!";
            $mess="<span style='color:".$color."'>".$messVal."</span>";
        }else{
            $mess="";
        }
    $research='
    <form method="get" action="tabAuthorBookList.php" >
        <input type="search" name="book_id" class="notPrint" value="'.$book_id.'" placeholder="book-ID">
        <input type="search" name="author_id" class="notPrint" value="'.$author_id.'" placeholder="author-ID">
        <tr class="addFormLine">
            <td class="column">
                <input type="search" name="book_id_search" class="searchInput" placeholder="Id">
            </td>
            <td class="column">
            <input type="search" name="book_title_search" class="searchInput" placeholder="Title">
            </td>
            <td class="column">
                <input type="search" name="book_type_search" class="searchInput" placeholder="Type">
            </td>
            <td class="column">
            <input type="search" name="book_kind_search" class="searchInput" placeholder="Kind">
            </td>
            <td class="column">
                <input type="search" name="book_number_search" class="searchInput" placeholder="Number">
            </td>
            <td class="column">
                <input type="search" name="book_free_number_search" class="searchInput" placeholder="Free Number">
            </td>
            <td class="column">
                <input readonly="readonly" type="search" name="author_id_search" class="searchInput" placeholder="Author ID">
            </td>
            <td class="column btnColumn">
                <div class="btnContainer">
                    <button class="btnMore btnSearch">Search</button></td>
                </div>
            </td>

        </tr>
    </form>
    
    
    ';
    $identification="book_id";
    $script="
        <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
        <script>
            document.querySelectorAll('.btnMoreClick').forEach(btn => {
                btn.addEventListener('click', event => {
                    const bookId = event.target.getAttribute('data-ident');
                    //console.log('book-ID:', bookId);
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', \"tabBookMore.php?book_id=$\{bookId}\");
                    xhr.send();
                    window.open('tabBookMore.php?book_id=' + bookId);
                    window.close();
                });
            });
        </script>
    ";

    //redirection of button return
    if ($book_id==""){
        //if the submit provid by author
        $hrefReturn="tabAuthor.php";
    }else{
        //if the submit provid by book
        $hrefReturn="tabBook.php";
    }   
    tabFormLoad($col,$hrefReturn,$mess,$title,$research,$stub,$identification,$script);

?>