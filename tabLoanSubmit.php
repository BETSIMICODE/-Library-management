<?php
    require_once "securing.php";
    require_once "loanSubmit.php";
    //recuperation loan information
    $col=showInformation($connection,"select * from loan where loan_id=?",[$loan_id]); //this variable contains the loan's (array)
    //file usefull for recording display
        require_once "listLoad.php";
        $valueCol=$col[0];
        $title="Loan Information";
        $hrefReturn="tabLoan.php";
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
                
                <div class="submitLine">
                <input class="submitBtn" type="submit" value="Modify" formaction="tabLoanSubmit.php">
                </div>
                <div class="submitLine">
                <input class="submitBtn" onclick="loanDelete()" id="deleteBtn" type="submit" value="Delete" formaction="tabLoanDelete.php">
                </div>
            </form>
            <script>
                function loanDelete() {
                    if(confirm("Do you really went delete this registre!")){
                        document.getElementById("deleteBtn").setAttribute("formaction", "tabLoanDelete.php");    // sets the value of the "formaction" attribute of the form
                        document.getElementById("deleteBtn").submit();  // submits the form
                    }else{event.preventDefault();}
                    }
            </script>
            ';



        listLoad($title,$form,$hrefReturn,$spanMess);
?>