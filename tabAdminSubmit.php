<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    $admin_mail=$_POST["admin_mail"];
    $admin_name=$_POST["admin_name"];
    $admin_password=$_POST["admin_password"];
    $password_verification=$_POST["password_verification"];
    if ($admin_mail=="" || $admin_password=="" || $password_verification=="" || $admin_name==""){
        //some input is empty
        $color="Yellow";
        $messVal="Please fill in the empty fields!";
        //variable needed to display the message
        
    }else if($admin_password!=$password_verification){
        //if the password and password verification are not same
        $color="Orange";
        $messVal="your password and the verification password are not the same please enter the same password!";
    }else{
        if ($admin_mail!=$_SESSION['user_mail'] && verification($connection,"select admin_mail from admin where admin_mail=?",[$admin_mail])){
            //if email address already exists
            $color="Orange";
            $messVal="This email address already exists!";
        }else if ($admin_name!=recupVal($connection,"select admin_name from admin where admin_mail=?",[$_SESSION['user_mail']],"admin_name") && verification($connection,"select admin_name from admin where admin_name=?",[$admin_name]) ){
            //if admin name  already exists
            $color="Orange";
            $messVal="this administrator name already exists!";
        }else{
            //modification of the information concerning the administrator
            $valUpdateAdmin=[$admin_mail,$admin_name,$admin_password,$admin_mail];
            $queryUpdateAdmin="update admin set admin_mail=?, admin_name=?, admin_password=?  where admin_mail=? ";
            addNewInformation($connection, $queryUpdateAdmin,$valUpdateAdmin);
            $color="green";
            $messVal="Modification done well!";
        }

    }
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    require_once "formTabAdminMore.php";
    listLoad($title,$form,$hrefReturn,$spanMess);
    
?>