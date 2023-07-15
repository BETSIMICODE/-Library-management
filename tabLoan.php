<?php
    require_once "securing.php";
    require_once "tabFormLoad.php";
    require_once "db-connection.php";
    require_once "queryFunction.php";
    require_once "calculFunction.php";
    //Checking if the search form has been submitted
    if ((isset($_GET['loan_id_search']) && !empty($_GET['loan_id_search'])) || (isset($_GET['member_id_search']) && !empty($_GET['member_id_search'])) || (isset($_GET['book_id_search']) && !empty($_GET['book_id_search']))  || (isset($_GET['loan_date_search']) && !empty($_GET['loan_date_search'])) || (isset($_GET['return_date_search']) && !empty($_GET['return_date_search'])) ) {
        //if it is submitted...

        $loan_id_search=$_GET['loan_id_search'];
        $book_id_search=$_GET['book_id_search'];
        $member_id_search=$_GET['member_id_search'];
        $loan_date_search=$_GET['loan_date_search'];
        $return_date_search=$_GET['return_date_search'];
        $valTabLoan=[];
        $whereTabLoan=[];
        if ($loan_id_search!=""){
            array_push($valTabLoan,$loan_id_search);
            array_push($whereTabLoan,"loan_id=?");
        }
        if ($member_id_search!=""){
            array_push($valTabLoan,$member_id_search);
            array_push($whereTabLoan,"member_id=?");
        }
        if ($book_id_search!=""){
            array_push($valTabLoan,$book_id_search);
            array_push($whereTabLoan,"book_id=?");
        }
        if ($loan_date_search!=""){
            array_push($valTabLoan,$loan_date_search);
            array_push($whereTabLoan,"loan_date=?");
        }
        if ($return_date_search!=""){
            if($return_date_search=="-" || $return_date_search==" "){
                array_push($whereTabLoan,"return_date is null");
            }else{
                echo(convertDate($return_date_search));
                array_push($valTabLoan,convertDate($return_date_search));
                array_push($whereTabLoan,"return_date=?");
            }
        }
        $whereTabLoanString=implode(' and ', $whereTabLoan);
        $queryTabLoan="select loan_id,loan_date,return_date,member_id,book_id from loan where ".$whereTabLoanString." order by loan_id asc";
        $col=showInformation($connection,$queryTabLoan,$valTabLoan);
        
    
    }else{
        //if not...
        $queryTabLoan="select loan_id,loan_date,return_date,member_id,book_id from loan order by loan_id asc";
        $col=showInformation($connection,$queryTabLoan,[]);
    }

    $stub=["Loan-id","Loan-Date","Return-Date","Member-Id","Book-Id"];
    $title="Loan information";
    //Message
        if(count($col)==0){
            $color="yellow";
            $messVal="No registration!";
            $mess="<span style='color:".$color."'>".$messVal."</span>";
        }else{
            $mess="";
        }
    $research='
    <form method="get" action="tabLoan.php" >
                    <tr class="addFormLine">
                        <td class="column">
                            <input type="search" name="loan_id_search" class="searchInput" placeholder="Loan-Id">
                        </td>
                        <td class="column">
                            <input name="loan_date_search" type="date" class="searchInput">
                        </td>
                        <td class="column">
                            <input name="return_date_search"  type="search" class="searchInput" placeholder="jj/mm/aaaa">
                        </td>
                        <td class="column">
                            <input name="member_id_search" type="search" class="searchInput" placeholder="Member-Id">
                        </td>
                        <td class="column">
                            <input name="book_id_search" type="search" class="searchInput" placeholder="Book-ID">
                        </td>
                        <td class="column btnColumn">
                            <div class="btnContainer">
                                <button class="btnMore btnSearch">Search</button></td>
                            </div>
                        </td>
        
                    </tr>
                </form>
    
    ';
    $hrefReturn="loan.php";
    $identification="loan_id";
    $script=
    "
    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
    <script>
        document.querySelectorAll('.btnMoreClick').forEach(btn => {
            btn.addEventListener('click', event => {
                const loanId = event.target.getAttribute('data-ident');
                console.log('Loan-ID:', loanId);
                const xhr = new XMLHttpRequest();
                xhr.open('GET', \"tabLoanMore.php?loan_id=$\{loanId}\");
                xhr.send();
                window.open('tabLoanMore.php?loan_id=' + loanId);
                window.close();
            });
        });
    </script>

    ";
    tabFormLoad($col,$hrefReturn,$mess,$title,$research,$stub,$identification,$script);
?>