<?php
    require_once "securing.php";
    require_once "generalyLoad.php";

    $styleTotal=[
        "styleH"=>"",
        "styleA"=>"",
        "styleM"=>"",
        "styleB"=>"",
        "styleL"=>$style,
        "styleD"=>""
    ];
    $navBottomContain='
    <h1>This is loan menu </h1>
    <div class="menu" id="loanMenu">
    <a class="btnMenu" id="addLoanBtn" href="addLoan.php">
        <p>
            ADD
        </p>
    </a>
    <a class="btnMenu" id="listLoanBtn" href="tabLoan.php">
        <p>
            LIST
        </p>
    </a>
    <a class="btnMenu" id="modifyLoanBtn" href="listLoanCharge.php">
        <p>
            REGISTER
        </p>
    </a>
    </div>';
    generalyLoad($styleTotal,$navBottomContain);
?>