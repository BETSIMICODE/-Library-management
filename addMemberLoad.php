<?php
require_once "securing.php";
function addMemberLoad($mess){
    //this function specify the addLoad with title, the button return , and the form...
    require_once "addLoad.php";
    $title="Add new member";
    $hrefReturn="member.php";
    $form=
    '
    <form action="addMemberSubmit.php" method="post">
    <div class="addFormLine" id="addFormLine1">
        <div class="lineLeft">
            <label class="labelTxt" for="memberName">Name</label> 
            <input type="text" name="member_name" class="inputInfo" id="memberName" placeholder="Name">

        </div>
        <div class="lineRight">
            <label class="labelTxt" for="memberFName">First names</label> 
            <input type="text" name="member_f_name"  class="inputInfo" id="memberFName" placeholder="First names">
        </div>
    </div>
    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="memberAddress">Address</label> 
            <input type="text" class="inputInfo" name="member_address"  id="memberAddress" placeholder="Address">
        </div>
        <div class="lineRight">
            <label class="labelTxt"  for="memberPhone">Phone </label> 
            <input type="text" class="inputInfo" name="member_phone" id="memberPhone" placeholder="Phone number">
        </div>
    </div>
    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="memberCard">Card years</label> 
            <input type="number" min="2015" max="2100" class="inputInfo" name="card_year"  id="memberCard" placeholder="Card years">
        </div>

    </div>

    
    <div class="submitLine">
        <input class="submitBtn" type="submit" value="SUBMIT">
    </div>



</form>
    ';
    addLoad($title,$form,$hrefReturn,$mess);

}

?>