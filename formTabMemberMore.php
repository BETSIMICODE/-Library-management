<?php
    require_once "securing.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
//recuperation member information
    $col=showInformation($connection,"select * from member where member_id=?",[$member_id]); //this variable contains the member's (array)
//file usefull for recording display
    require_once "listLoad.php";
    $valueCol=$col[0];
    $title="member Information";
    $hrefReturn="tabMember.php";
    $form=
    '
    <form  method="post">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="memberId">Id</label> 
                <input readonly="readonly" type="text" name="member_id" value= "'.$valueCol["member_id"].'" class="inputInfo" id="memberId" placeholder="Id" >
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="cardYear">Card year</label> 
            <input  type="text" name="card_year" value= "'.$valueCol["card_year"].'" class="inputInfo" id="cardYear" >
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="memberName">Name</label> 
                <input  type="text" name="member_name" value= "'.$valueCol["member_name"].'" class="inputInfo" id="memberName" >
            </div>
            <div class="lineRight">
            <label class="labelTxt" for="memberFName">First Name</label> 
            <input  type="text" name="member_f_name" value= "'.$valueCol["member_f_name"].'" class="inputInfo" id="memberFName" >
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="memberAddress">Address</label> 
                <input  type="text" name="member_address" value= "'.$valueCol["member_address"].'" class="inputInfo" id="memberAddress" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="memberPhone">Phone</label> 
                <input type="text"  name="member_phone" class="inputInfo" value= "'.$valueCol["member_phone"].'" id="memberPhone" placeholder="Phone">
            </div>
        </div>
        
        <div class="submitLine">
            <input class="submitBtn" type="submit" value="Modify" formaction="tabMemberSubmit.php">
        </div>
        <div class="submitLine">
            <input class="submitBtn" onclick="memberDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabMemberDelete.php">
        </div>
    </form>
    <script>
        function memberDelete() {
            if(confirm("Do you really went delete this registre and the loan concerned?")){
                document.getElementById("deleteBtn").setAttribute("formaction","tabMemberDelete.php");    // sets the value of the "formaction" attribute of the form
                document.getElementById("deleteBtn").submit();  // submits the form
            }else{event.preventDefault();}
            }
    </script>
    ';

?>