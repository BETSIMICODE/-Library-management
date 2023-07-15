<?php
require_once "securing.php";
////recuperation search's values
    $loan_id=$_POST["loan_id"];
    $search_val=$_POST["search_val"];
    if($search_val==""){
        $color="Yellow";
        $messVal="No Loan-ID written...";
        //variable needed to display the message
        $spanMess="<span style='color:".$color."'>".$messVal."</span>";
        //call the file listLoan.php to refresh the page
            require_once "listLoan.php";
        //get the registration number
            for ($i=0; $i <count($col) ; $i++) { 
                if($col[$i]["loan_id"]==$loan_id){
                    break;
                }
            }
        //charge the page
            listLoan($i,$col,$spanMess);
    }else{

        $j=false; // initialize...false if search_val don't exists...
        
        //call the file listLoan.php to refresh the page
            require_once "loanCol.php";
            //get the registration number
                for ($i=0; $i <count($col) ; $i++) { 
                    if($col[$i]["loan_id"]==$search_val){
                        $j=true;
                        break;
                    }
                }
            require_once "listLoad.php";
                if($j){
                    //if record exists
                    $valueCol=$col[$i];
                    $title="Loan Information n° ".strVal($i+1);
                    $hrefReturn="listLoanCharge.php";
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
                            <div class="submitLine4">
                                <button id="btnResearch" class="btnRegistery">Research</button>
                                <input id="searchVal" class="searchIN" type="search" placeholder="Enter the loan Id" name="search_val">
                                <input class="searchIN" type="submit" value="Search" id="btnSearch" formaction="listSearch.php">
                            </div>
                            <input type="number"  name="iValue"  value= '.$i.' class="iVal" placeholder="iVal">
                            <div class="submitLine">
                            <input class="submitBtn" type="submit" value="Modify" formaction="listLoanSubmit.php">
                            </div>
                            <div class="submitLine">
                            <input class="submitBtn" onclick="loanDelete()" id="deleteBtn" type="submit" value="Delete" formaction="listLoanDelete.php">
                            </div>
                        </form>
                        <script>
                            function loanDelete() {
                                if(confirm("Do you really went delete this registre!")){
                                    document.getElementById("deleteBtn").setAttribute("formaction", "listLoanDelete.php");    // sets the value of the "formaction" attribute of the form
                                    document.getElementById("deleteBtn").submit();  // submits the form
                                }else{
                                    event.preventDefault();
                                }
                                }
                        </script>
                        ';
        
        
        
                    listLoad($title,$form,$hrefReturn,"");
                }
                else{
                    $title="Loan ID not existing...";
                    $hrefReturn="listLoanCharge.php";
                    $form="";
                    listLoad($title,$form,$hrefReturn,"");
                }
    }
?>