<?php
    require_once "securing.php";
    require_once "tabFormLoad.php";
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //Checking if the search form has been submitted
    if ((isset($_GET['member_id_search']) && !empty($_GET['member_id_search'])) || (isset($_GET['member_name_search']) && !empty($_GET['member_name_search'])) || (isset($_GET['member_f_name_search']) && !empty($_GET['member_f_name_search'])) || (isset($_GET['member_address_search']) && !empty($_GET['member_address_search'])) || (isset($_GET['member_phone_search']) && !empty($_GET['member_phone_search'])) || (isset($_GET['card_year_search']) && !empty($_GET['card_year_search'])) ){
        
        //if it is submitted...
        $member_id_search=$_GET['member_id_search'];
        $member_name_search=$_GET['member_name_search'];
        $member_f_name_search=$_GET['member_f_name_search'];
        $member_address_search=$_GET['member_address_search'];
        $member_phone_search=$_GET['member_phone_search'];
        $card_year_search=$_GET['card_year_search'];
        
        $valTabMember=[];
        $whereTabMember=[];
        if ($member_id_search!=""){
            array_push($valTabMember,$member_id_search);
            array_push($whereTabMember,"member_id=?");
        }
        if ($member_name_search!=""){
            array_push($valTabMember,$member_name_search);
            array_push($whereTabMember,"member_name=?");
        }
        if ($member_f_name_search!=""){
            array_push($valTabMember,$member_f_name_search);
            array_push($whereTabMember,"member_f_name=?");
        }
        if ($member_address_search!=""){
            array_push($valTabMember,$member_address_search);
            array_push($whereTabMember,"member_address=?");
        }
        if ($member_phone_search!=""){
            array_push($valTabMember,$member_phone_search);
            array_push($whereTabMember,"member_phone=?");
        }
        if ($card_year_search!=""){
            array_push($valTabMember,$card_year_search);
            array_push($whereTabMember,"card_year=?");
        }
        $whereTabMemberString=implode(' and ', $whereTabMember);
        $queryTabLoan="select member_id,member_name,member_f_name,member_address,member_phone,card_year from member where ".$whereTabMemberString." order by member_id asc";
        $col=showInformation($connection,$queryTabLoan,$valTabMember);

    }else{
        //if not...
        $queryTabLoan="select member_id,member_name,member_f_name,member_address,member_phone,card_year from member order by member_id asc";
        $col=showInformation($connection,$queryTabLoan,[]);
    }




    
    $stub=["Id","Name","First Names","Address","Phone","Card year"];
    $title="Member information";



    //Message
        if(count($col)==0){
            $color="yellow";
            $messVal="No registration!";
            $mess="<span style='color:".$color."'>".$messVal."</span>";
        }else{
            $mess="";
        }
    $research='
    <form method="get" action="tabMember.php" >
    <tr class="addFormLine">
        <td class="column">
            <input type="search" name="member_id_search" class="searchInput" placeholder="Id">
        </td>
        <td class="column">
        <input type="search" name="member_name_search" class="searchInput" placeholder="Name">
        </td>
        <td class="column">
            <input type="search" name="member_f_name_search" class="searchInput" placeholder="First Names">
        </td>
        <td class="column">
        <input type="search" name="member_address_search" class="searchInput" placeholder="Address">
        </td>
        <td class="column">
            <input type="search" name="member_phone_search" class="searchInput" placeholder="Phone">
        </td>
        <td class="column">
            <input type="search" name="card_year_search" class="searchInput" placeholder="Free Card Year">
        </td>
        <td class="column btnColumn">
            <div class="btnContainer">
                <button class="btnMore btnSearch">Search</button></td>
            </div>
        </td>

    </tr>
</form>
    ';
    $hrefReturn="member.php";
    $identification="member_id";
    $script="
    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
    <script>
        document.querySelectorAll('.btnMoreClick').forEach(btn => {
            btn.addEventListener('click', event => {
                const memberId = event.target.getAttribute('data-ident');
                //console.log('member-Id:', memberId);
                const xhr = new XMLHttpRequest();
                xhr.open('GET', \"tabMemberMore.php?member_id=$\{memberId}\");
                xhr.send();
                window.open('tabMemberMore.php?member_id=' + memberId);
                window.close();
            });
        });
    </script>
";
    tabFormLoad($col,$hrefReturn,$mess,$title,$research,$stub,$identification,$script);
?>