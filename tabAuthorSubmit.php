<?php
require_once "securing.php";

try {
    //code...
    //function usefull for changing the book author id...
    function changeBookAuthorIdToAuthorIdRecup($connection,$author_id_recup,$book_id){
        //modification of the information concerning the book
            $valUpdateBook=[$author_id_recup,$book_id];
            $queryUpdateBook="update Book set author_id=? where book_id=?";
            addNewInformation($connection, $queryUpdateBook,$valUpdateBook);
    }
    function hrefReturnFunction($book_id){
        if ($book_id==""){
            //if the submit provid by author
            return "tabAuthor.php";
        }else{
            //if the submit provid by book
            return "tabBook.php";
        }

    }
    function AuthorDeleteBtnFunction($book_id){
        if ($book_id==""){
            //if the submit provid by author
            return '
            <div class="submitLine">
                <input class="submitBtn" onclick="authorDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabAuthorDelete.php">
            </div>';
        }else{
            //if the submit provid by book
            return "";
        }
    }
    
    //recuperation author information...
    $book_id=$_POST["book_id"];
    $author_id=$_POST["author_id"];
    if(isset($_POST['author_name']) && !empty($_POST['author_name'])){
        $author_name=$_POST["author_name"];
    
    }else{
        $author_name="";
    }
    if(isset($_POST['author_nick_name']) && !empty($_POST['author_nick_name'])){
        $author_nick_name=$_POST["author_nick_name"];
    }else{
        $author_nick_name="";
    }
    if(isset($_POST['author_nick_name']) && !empty($_POST['author_nick_name'])){
        $author_f_name=$_POST["author_f_name"];
    }else{
        $author_f_name="";
    }
    

    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";

    if ($author_name==""){
        //if the information is incomplete (the name of the author is required) 
        $color="yellow";
        $messVal="Information incompleted!";
    }else{
        //if the minimum information submited

        //variable usefull for verification author existence
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
                //check if the author already exists
                if(verificationDifferent($connection,$queryVerAuthor,$valQueryAuthor,"author_id",$author_id)){
                    //exists apart from itself
                    $author_id_new=recupValVerificationDifferent($connection,$queryVerAuthor,$valQueryAuthor,"author_id",$author_id);
                    if ($book_id==""){
                        //if the submit provid by author
                        $color="yellow";
                        $messVal="Author already  exists! His author-ID=".$author_id_new;
                    }else{
                        //if the submit provid by book
                        //change the author of the book
                        addNewInformation($connection,"update book set author_id=? where book_id=?",[$author_id_new,$book_id]);
                        $color="green";
                        $messVal="Modification well done, the author of the book n°".$book_id."has been changed to author n°".$author_id_new;
                    }
                    
                }else{
                    $color="yellow";
                    $messVal="Same information as the antecedent ";
                }
            }else{
                //The author does not yet exist
                if ($book_id==""){
                    //if the submit provid by author
                    //modification of the information concerning the author
                        $valUpdateAuthor=[$author_name,$author_f_name,$author_nick_name,$author_id];
                        $queryUpdateAuthor="update author set author_name=?, author_f_name=?, author_nick_name=? where author_id=?";
                        addNewInformation($connection, $queryUpdateAuthor,$valUpdateAuthor);
                        $color="green";
                        $messVal="Modification done well!";
                }else{
                    //if the submit provid by book
                    
                    $numberBookWriting=count(showInformation($connection,"select * from book where author_id=?",[$author_id]));
                    //verification if other book has the same author
                    if ($numberBookWriting>1){
                        //The author has written more than one book
                        //add new author 
                            $valQueryAuthor_1=[$author_name, $author_f_name, $author_nick_name];
                            $queryAddAuthor="insert into author(author_name, author_f_name, author_nick_name) values (?,?,?)";
                            addNewInformation($connection,$queryAddAuthor,$valQueryAuthor_1);
                            //recuperation author id new
                            $author_id_new=recupVal($connection,$queryVerAuthor,$valQueryAuthor,"author_id");
                            //change current book author_id to new author_id_new
                            changeBookAuthorIdToAuthorIdNew($connection,$author_id_new,$book_id);
                            $color="blue";
                            $messVal="The author of book-id=".$book_id." was changed to new author id=".$author_id_new;
                            
                    }else{
                        //The author only wrote the current book
                        //Edit current author information
                        //modification of the information concerning the author
                        $valUpdateAuthor=[$author_name,$author_f_name,$author_nick_name,$author_id];
                        $queryUpdateAuthor="update author set author_name=?, author_f_name=?, author_nick_name=? where author_id=?";
                        addNewInformation($connection, $queryUpdateAuthor,$valUpdateAuthor);
                        $color="green";
                        $messVal="Modification done well!";
                    }

                }
                //modification of the information concerning the author
                $valUpdateAuthor=[$author_name,$author_f_name,$author_nick_name,$author_id];
                $queryUpdateAuthor="update author set author_name=?, author_f_name=?, author_nick_name=? where author_id=?";
                addNewInformation($connection, $queryUpdateAuthor,$valUpdateAuthor);
                $color="green";
                $messVal="Modification done well!";
            }

            
    }

} catch (Exception $th) {
    $color="red";
    $messVal="An error occured!";
    



}
    $hrefReturn=hrefReturnFunction($book_id);
    $AuthorDeleteBtn=AuthorDeleteBtnFunction($book_id);
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    require_once "formTabAuthorMore.php";
    listLoad($title,$form,$hrefReturn,$spanMess);

?>