<?php
require_once "securing.php";
function addAdminLoad($mess){
    //this function specify the add load with title, the button return , and the form...
    require_once "addLoad.php";
    $title="Add new administrator";
    $hrefReturn="admin.php";
    $form=
    '
    <form method="post" action="addAdminSubmit.php">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="adminName">Name</label> 
                <input type="text" name="admin_name" class="inputInfo" id="adminName" placeholder="Name">

            </div>
            <div class="lineRight">
                <label class="labelTxt" for="adminMail">Mail</label> 
                <input type="text" name="admin_mail" class="inputInfo" id="adminMail" placeholder="Address Mail">
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="adminPassword">Password</label> 
                <input type="password" name="admin_password" class="inputInfo" id="adminPassword"  placeholder="Write your password">
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="adminPasswordConf">Password confirmation</label> 
                <input type="password" name="admin_password_conf" class="inputInfo" id="adminPasswordConf" placeholder="Rewrite your password">
            </div>
        </div>

        <div class="submitLine">
            <input class="submitBtn" type="submit" value="SUBMIT">
        </div>
    </form>';
    addLoad($title,$form,$hrefReturn,$mess);


}
    
?>