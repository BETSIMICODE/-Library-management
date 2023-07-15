<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
//recuperation admin information
    $col=showInformation($connection,"select * from admin where admin_mail=?",[$admin_mail]); //this variable contains the admin's (array)
//file usefull for recording display
    require_once "listLoad.php";
    $valueCol=$col[0];
    $title="Administrator Information";
    $hrefReturn="tabAdmin.php";
    $form=
    '
    <form  method="post">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="adminMail">E-Mail</label> 
                <input type="text" name="admin_mail" value= "'.$valueCol["admin_mail"].'" class="inputInfo" id="adminMail" placeholder="Address email" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="adminName">Name</label> 
                <input type="text"  name="admin_name" class="inputInfo" value= "'.$valueCol["admin_name"].'" id="adminName" placeholder="Name">
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="password">Password</label> 
                <input  type="password" name="admin_password" value= "'.$valueCol["admin_password"].'" class="inputInfo" id="password" >
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="passwordVerif">Password Verification</label> 
            <input  type="password" name="password_verification" value= "'.$valueCol["admin_password"].'" class="inputInfo" id="passwordVerif" >
            </div>
        </div>
        <div class="submitLine">
            <input class="submitBtn" type="submit" value="Modify" formaction="tabAdminSubmit.php">
        </div>
        <div class="submitLine">
            <input class="submitBtn" onclick="adminDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabAdminDelete.php">
        </div>
    </form>
    <script>
        function adminDelete() {
            if(confirm("Do you really went delete this registre and to disconnect?")){
                document.getElementById("deleteBtn").setAttribute("formaction","tabAdminDelete.php");    // sets the value of the "formaction" attribute of the form
                document.getElementById("deleteBtn").submit();  // submits the form
            }else{event.preventDefault();}
            }
    </script>




    ';

?>