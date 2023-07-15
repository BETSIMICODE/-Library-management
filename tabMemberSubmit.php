<?php
    require_once "securing.php";
    try {
        //code...
        //file usefull for database'manipulation
        require_once "db-connection.php";
        require_once "queryFunction.php";
    
        //recuperation add new member's values
        $member_id= $_POST["member_id"];
        $member_name= $_POST["member_name"];
        $member_f_name= $_POST["member_f_name"];
        $member_address= $_POST["member_address"];
        $member_phone= $_POST["member_phone"];
        $card_year= $_POST["card_year"];
    
        if ($member_f_name==""){
            $member_f_name=" ";
        }
        if ($member_name=="" || $member_f_name=="" ||$member_address=="" ||$member_phone==""){
            //message and color to print in the form
            $color="yellow";
            $messVal="Incomplete information, please retry!!";
        }else{
            //modification of the information concerning the member
            $valUpdatemember=[$member_name,$member_f_name,$member_address,$member_phone,$card_year,$member_id];
            $queryUpdatemember="update member set member_name=?, member_f_name=?, member_address=?, member_phone=?, card_year=? where member_id=?";
            addNewInformation($connection, $queryUpdatemember,$valUpdatemember);
            $color="green";
            $messVal="Modification done well!";
        }

    } catch (Exception $th) {
        $color="red";
        $messVal="An error occured!";
        
    }
    $spanMess="<span style='color:".$color."'>".$messVal."</span>";
    require_once "formTabMemberMore.php";
        listLoad($title,$form,$hrefReturn,$spanMess);


?>