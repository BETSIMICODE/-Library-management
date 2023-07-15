<?php
require_once "securing.php";
function addLoanLoad($mess){
    //this function specify the add load with title, the button return , and the form...

    require_once "addLoad.php";
    $title="Add new loan";
    $hrefReturn="loan.php";
    $form=
    '
    <form action="addLoanSubmit.php" method="post">
    <div class="addFormLine" id="addFormLine1">
        <div class="lineLeft">
            <label class="labelTxt" for="loanDate">Date</label> 
            <input type="date" name="loan_date" class="inputInfo" id="loanDate" >

        </div>
    </div>
    <div class="addFormLine">
        <div class="lineLeft">
            <label class="labelTxt" for="bookId">Book ID</label> 
            <input type="number" min="1" name="book_id" class="inputInfo" id="bookId" placeholder="Book ID">
        </div>
        <div class="lineRight">
            <label class="labelTxt"  for="memberId">Member ID </label> 
            <input type="number" min="1" name="member_id" class="inputInfo" id="memberId" placeholder="Member ID">
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