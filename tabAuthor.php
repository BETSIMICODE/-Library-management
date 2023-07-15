<?php
    require_once "securing.php";
    require_once "tabFormLoad.php";
    require_once "db-connection.php";
    require_once "queryFunction.php";

     //Checking if the search form has been submitted
        if ((isset($_GET['author_name_search']) && !empty($_GET['author_name_search'])) || (isset($_GET['author_id_search']) && !empty($_GET['author_id_search'])) || (isset($_GET['author_f_name_search']) && !empty($_GET['author_f_name_search'])) || (isset($_GET['author_nick_name_search']) && !empty($_GET['author_nick_name_search']))){
            //if it is submitted...
            $author_name_search=$_GET['author_name_search'];
            $author_id_search=$_GET['author_id_search'];
            $author_f_name_search=$_GET['author_f_name_search'];
            $author_nick_name_search=$_GET['author_nick_name_search'];
            $valTabAuthor=[];
            $whereTabAuthor=[];

            if ($author_id_search!=""){
                //if the input author_id_search is not empty 
                array_push($valTabAuthor,$author_id_search);
                array_push($whereTabAuthor,"author_id=?");
            }
            if ($author_name_search!=""){
                //if the input author_name_search is not empty 
                array_push($valTabAuthor,$author_name_search);
                array_push($whereTabAuthor,"author_name=?");
            }
            if ($author_f_name_search!=""){
                //if the input author_name_search is not empty 
                array_push($valTabAuthor,$author_f_name_search);
                array_push($whereTabAuthor,"author_f_name=?");
            }
            if ($author_nick_name_search!=""){
                //if the input author_name_search is not empty 
                array_push($valTabAuthor,$author_nick_name_search);
                array_push($whereTabAuthor,"author_nick_name=?");
            }
            
            $whereTabAuthorString=implode(' and ', $whereTabAuthor);
            $queryTabAuthor="select author_id, author_name, author_f_name, author_nick_name from author where ".$whereTabAuthorString." order by author_id asc";
            $col=showInformation($connection,$queryTabAuthor,$valTabAuthor);
        }else{
            //if not...
            $queryTabAuthor="select author_id, author_name, author_f_name, author_nick_name from author order by author_id asc";
            $col=showInformation($connection,$queryTabAuthor,[]);
        }

    
    $stub=["Id","Nick-name","Name","Firts-names"];
    $title="author information";
    //Message
    if(count($col)==0){
        $color="yellow";
        $messVal="No registration!";
        $mess="<span style='color:".$color."'>".$messVal."</span>";
    }else{
        $mess="";
    }
    $research='
    <form method="get" action="tabauthor.php" >
    <tr class="addFormLine">
        <td class="column">
            <input name="author_id_search" type="search" class="searchInput" placeholder="Id">
        </td>
        <td class="column">
            <input type="search" name="author_nick_name_search" class="searchInput" placeholder="Nick-name">
        </td>
        <td class="column">
            <input type="search" name="author_name_search" class="searchInput" placeholder="Name">
        </td>
        <td class="column">
            <input type="search" name="author_f_name_search" class="searchInput" placeholder="First-names">
        </td>
        <td class="column btnColumn">
            <div class="btnContainer">
                <button class="btnMore btnSearch">Search</button></td>
            </div>
        </td>

    </tr>
</form>
    
    ';





    
    $hrefReturn="book.php";
    $identification="author_id";
    $script="
    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
    <script>
        document.querySelectorAll('.btnMoreClick').forEach(btn => {
            btn.addEventListener('click', event => {
                const authorId = event.target.getAttribute('data-ident');
                //console.log('author-ID:', authorId);
                const xhr = new XMLHttpRequest();
                xhr.open('GET', \"tabAuthorMore.php?author_id=$\{authorId}\");
                xhr.send();
                window.open('tabAuthorMore.php?author_id=' + authorId);
                window.close();
            });
        });
    </script>
";
    tabFormLoad($col,$hrefReturn,$mess,$title,$research,$stub,$identification,$script);
?>