<?php
require_once "securing.php";
function listLoanLoad($mess,$valueCol,$i){

    require_once "listLoad.php";
    $title="Loan Information n° ".strVal($i+1);
    $hrefReturn="loan.php";
    $form=
    '
    <form  method="post">
        <div class="addFormLine" id="addFormLine1">
            <div class="lineLeft">
                <label class="labelTxt" for="loanDate">Date</label> 
                <input readonly="readonly" type="date" name="loan_date" value= '.$valueCol["loan_date"].' class="inputInfo" id="loanDate" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="returnDate">Date return</label> 
                <input type="date"  name="return_date" class="inputInfo" value= '.$valueCol["return_date"].' id="returnDate" placeholder="Date return">
            </div>
        </div>
        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="loanId">Loan ID</label> 
                <input readonly="readonly" type="number" name="loan_id" value= '.$valueCol["loan_id"].' class="inputInfo" id="loanId" >
            </div>
            <div class="lineRight">
                <label class="labelTxt"  for="memberId">Member ID </label> 
                <input readonly="readonly" type="number" min="1" name="member_id" class="inputInfo" value= '.$valueCol["member_id"].' id="memberId" placeholder="Member ID">
            </div>
        </div>


        <div class="addFormLine">
            <div class="lineLeft">
                <label class="labelTxt" for="bookId">Book ID</label> 
                <input readonly="readonly" type="number" min="1" name="book_id" value= '.$valueCol["book_id"].' class="inputInfo" id="bookId" placeholder="Book ID">
            </div>
            <div class="lineRight">
                <label class="labelTxt" for="penaltyCost">Penalty cost</label> 
                <input type="number" min="0" name="penalty_cost" value= '.$valueCol["penalty_cost"].' class="inputInfo" id="penaltyCost" placeholder="Penalty cost">
            </div>
        </div>

        <input type="number"  name="iValue"  value= '.$i.' class="iVal" placeholder="iVal">
        <div class="submitLine4">
            <button id="btnResearch" class="btnRegistery">Research</button>
            <input id="searchVal" class="searchIN" type="search" placeholder="Enter the loan Id" name="search_val">
            <input class="searchIN" type="submit" value="Search" id="btnSearch" formaction="listSearch.php">
        </div>
        <div class="submitLine2">
            <input class="btnRegistery" type="submit" value="First" formaction="listLoanChargeFirst.php">
            <input class="btnRegistery" type="submit" value="Previous" formaction="listLoanChargePrev.php">
            <input class="btnRegistery" type="submit" value="Next" formaction="listLoanChargeNext.php">
            <input class="btnRegistery" type="submit" value="Last" formaction="listLoanChargeLast.php">
        </div>
        <div class="submitLine">
        <input class="submitBtn" type="submit" value="Modify" formaction="listLoanSubmit.php">
        </div>
        <div class="submitLine">
        <input class="submitBtn" onclick="loanDelete()" id="deleteBtn" type="submit" value="Delete" formaction="listLoanDelete.php">
        </div>
    </form>
    <script>
        function loanDelete() {
            if(confirm("Are you sure you want to delete this record?")){
                document.getElementById("deleteBtn").setAttribute("formaction", "listLoanDelete.php");    
                document.getElementById("deleteBtn").submit(); 
            }else{event.preventDefault();}
            }
    </script>
    ';
    listLoad($title,$form,$hrefReturn,$mess);
}

?>