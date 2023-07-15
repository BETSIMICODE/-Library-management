<?php
    require_once "securing.php";
    require_once "generalyLoad.php";
    $styleTotal=[
        "styleH"=>"",
        "styleA"=>"",
        "styleM"=>$style,
        "styleB"=>"",
        "styleL"=>"",
        "styleD"=>""
    ];
    $navBottomContain='
    <h1>This is member menu </h1>
    <div class="menu" id="memberMenu">
    <a class="btnMenu" id="addMemberBtn" href="addMember.php">
        <p>
            ADD
        </p>
    </a>
    <a href="tabMember.php" class="btnMenu" id="listMemberBtn">
        <p>
            LIST
        </p>
    </a>
    </div>';
    generalyLoad($styleTotal,$navBottomContain);
?>