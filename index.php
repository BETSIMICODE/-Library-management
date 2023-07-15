<?php
    require_once "db-connection.php";
    require_once "queryFunction.php";
    if (count(showInformation($connection,"select * from admin",[]))==0){
        //first connection
        addNewInformation($connection,"insert into admin (admin_mail,admin_name,admin_password) values (?,?,?);",["users","users","admin"]);
        $mess="Use the email and password that has just been provided";
        echo "<script>alert('Welcome to this application, the default mail administrator is: users. And the password is: admin');</script>";
        
    }else{
        //an administrator exists
        $mess="";
        
    }
    require_once "loginLoad.php";
    loginLoad($mess);
    exit();
?>