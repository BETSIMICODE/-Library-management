<?php
session_start();
//recuperation login's values
    $login_mail= $_GET["mail_input"];
    $login_passwd= $_GET["passwd_input"];
    // echo "Mail input=".$login_mail." Password input=".$login_passwd;

//Call file db-connection.php for connect to dabatabase 
    require_once 'db-connection.php';
//Call file queryFunction.php who have function verification for verify the login
    require_once 'queryFunction.php';
    $query="select * from admin where admin_mail=? and admin_password=?";
    $param_val=[$login_mail,$login_passwd];
    if (verification($connection,$query,$param_val)){
        // Authentication was successful, set "loggedin" variable to true
        $_SESSION['loggedin'] = true;
        $_SESSION['user_mail'] = $login_mail;
        header('Location: home.php');
        exit();
    }else{
        require_once 'loginLoad.php';
        loginLoad("Authentification Error!");
        exit();
    

    };



?>