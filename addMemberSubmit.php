<?php
require_once "securing.php";
// when we submit the new loan this file is calling...

    try {
        //code...
        //recuperation add new member's values
        $member_name= $_POST["member_name"];
        $member_f_name= $_POST["member_f_name"];
        $member_address= $_POST["member_address"];
        $member_phone= $_POST["member_phone"];
        $card_year= $_POST["card_year"];

        if ($member_f_name==""){
            $member_f_name=" ";
        }
        if ($member_name=="" || $member_f_name=="" ||$member_address=="" ||$member_phone=="" || $card_year==""){
            //message and color to print in the form
            $color="red";
            $messVal="Wrong or incomplete information, please verify and try again!!";
        }else{
            //call file queryFunction.php and db-connection.php
            require_once "queryFunction.php";
            require_once "db-connection.php";
            //verification member existence
            $queryMemberVer="select * from member where member_f_name=? and member_name=? and member_address=?";
            $valQueryMember=[$member_f_name,$member_name,$member_address];
            if(verification($connection,$queryMemberVer,$valQueryMember)){
                //message and color to print in the form
                $color="Yellow";
                $messVal="Member already exists!";
            }else{
                //add new member 
                $valQueryMember=array_merge($valQueryMember,[$member_phone,$card_year]);
                $queryAddMember="insert into member(member_f_name, member_name, member_address, member_phone, card_year) values (?,?,?,?,?)";
                addNewInformation($connection,$queryAddMember,$valQueryMember);
                //member_id recuperation
                $member_id=recupVal($connection,"select member_id from member where member_name=? and member_f_name=? and member_address=? and member_phone=? and card_year=?",[$member_name,$member_f_name,$member_address,$member_phone,$card_year],"member_id");
                //message and color to print in the form
                $messVal="Member successfully added, member-id=".$member_id;
                $color="green";
            }
        }
    }catch (Exception $th){
        //message and color to print in the form
        $color="red";
        $messVal="Wrong or incomplete information, please verify and try again!!";
        
    }



    //call the file addMemberLoad who have the function addMemberLoad($mess)
    require_once "addMemberLoad.php";
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    addMemberLoad($spanMess);
    //script who print the add message 
    // echo "<script> alert('".$messVal."');</script>";
?>