<?php
require_once "securing.php";
// when we submit the new admin this file is calling...
try {
    //code...
    //recuperation add new admin's values
    $admin_name= $_POST["admin_name"];
    $admin_mail= $_POST["admin_mail"];
    $admin_password= $_POST["admin_password"];
    $admin_password_conf= $_POST["admin_password_conf"];
    

    //call file queryFunction.php and db-connection.php
    require_once "queryFunction.php";
    require_once "db-connection.php";
    
    //verification admin existence
    $queryAdminVer="select * from admin where admin_mail=? or admin_name=?";
    $valQueryAdminVer=[$admin_mail,$admin_name];
    if(verification($connection,$queryAdminVer,$valQueryAdminVer)){
        
        //message and color to print in the form
        $color="Yellow";
        $messVal="Admin already exists!";
    }else{
        if ($admin_name=="" || $admin_mail=="" ||$admin_password==""){
            //message and color to print in the form
            $color="red";
            $messVal="Wrong or incomplete information, please verify and try again!!";
        
        }else if($admin_password==$admin_password_conf){
            //message and color to print in the form
            $valQueryAdminAdd=[$admin_mail,$admin_name,$admin_password];
            //add new administrator 
            $queryAddAdmin="insert into admin(admin_mail, admin_name, admin_password) values (?,?,?)";
            addNewInformation($connection,$queryAddAdmin,$valQueryAdminAdd);
            
            //message and color to print in the form
            $messVal="Administrator successfully added";
            $color="green";

        }else{
            //message and color to print in the form
            $color="#f39418";
            $messVal="Password not same!";
        }
        
    }
    
    
    
} catch (Exception $th) {
    $color="red";
    $messVal="Wrong or incomplete information, please verify and try again!!";
}



//call the file addAdminLoad who have the function addAdminLoad($mess)
require_once "addAdminLoad.php";
$spanMess="<span style='color:".$color."'>".$messVal."</span>";
addAdminLoad($spanMess);
//script who print the add message 
// echo "<script> alert('".$messVal."');</script>";
?>