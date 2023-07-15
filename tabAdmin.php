<?php
    require_once "securing.php";
    require_once "tabFormLoad.php";
    require_once "db-connection.php";
    require_once "queryFunction.php";

     //Checking if the search form has been submitted
        if ((isset($_GET['admin_name_search']) && !empty($_GET['admin_name_search'])) || (isset($_GET['admin_mail_search']) && !empty($_GET['admin_mail_search']))){
            //if it is submitted...
            $admin_name_search=$_GET['admin_name_search'];
            $admin_mail_search=$_GET['admin_mail_search'];
            $valTabAdmin=[];
            $whereTabAdmin=[];

            if ($admin_mail_search!=""){
                //if the input admin_mail_search is not empty 
                array_push($valTabAdmin,$admin_mail_search);
                array_push($whereTabAdmin,"admin_mail=?");
            }
            if ($admin_name_search!=""){
                //if the input admin_name_search is not empty 
                array_push($valTabAdmin,$admin_name_search);
                array_push($whereTabAdmin,"admin_name=?");
            }
            $whereTabAdminString=implode(' and ', $whereTabAdmin);
            $queryTabAdmin="select admin_name,admin_mail from admin where ".$whereTabAdminString." order by admin_name asc";
            $col=showInformation($connection,$queryTabAdmin,$valTabAdmin);
        }else{
            //if not...
            $queryTabAdmin="select admin_name,admin_mail from admin order by admin_name asc";
            $col=showInformation($connection,$queryTabAdmin,[]);
        }

    
    $stub=["Name","E-mail"];
    $title="Admin information";
    if (isset($_GET['admin_mail']) && !empty($_GET['admin_mail'])){
        //if the users clickes to the button more and he is not the administrator clicked
        $color="yellow";
        $messVal="You can't see more information about this administrator because he is not you !";
        $mess="<span style='color:".$color."'>".$messVal."</span>";
    }else{
        //if the users don't clicked to the button more...
        $mess="";
    }
    $research='
    <form method="get" action="tabAdmin.php" >
    <tr class="addFormLine">
        <td class="column">
            <input type="search" name="admin_name_search" class="searchInput" placeholder="Name">
        </td>
        <td class="column">
            <input name="admin_mail_search" type="search" class="searchInput" placeholder="E-Mail">
        </td>
        <td class="column btnColumn">
            <div class="btnContainer">
                <button class="btnMore btnSearch">Search</button></td>
            </div>
        </td>

    </tr>
</form>
    
    ';





    
    $hrefReturn="admin.php";
    $identification="admin_mail";
    $script="
    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
    <script>
        document.querySelectorAll('.btnMoreClick').forEach(btn => {
            btn.addEventListener('click', event => {
                const admin_mail = event.target.getAttribute('data-ident');
                //console.log('Admin-mail:', admin_mail);
                if (admin_mail=='".$_SESSION['user_mail']."'){
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', \"tabAdminMore.php?admin_mail=$\{admin_mail}\");
                    xhr.send();
                    window.open('tabAdminMore.php?admin_mail=' + admin_mail);
                    window.close();
                }else{
                    console.log('Admin-mail:', admin_mail);
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', \"tabAdmin.php?admin_mail=$\{admin_mail}\");
                    xhr.send();
                    window.open('tabAdmin.php?admin_mail=' + admin_mail);
                    window.close();
                }
                
            });
        });
    </script>
    
    
    
    
    ";
    tabFormLoad($col,$hrefReturn,$mess,$title,$research,$stub,$identification,$script);
?>