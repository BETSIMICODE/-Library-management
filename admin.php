<?php
    require_once "securing.php";
    require_once "generalyLoad.php";
    $styleTotal=[
        "styleH"=>"",
        "styleA"=>$style,
        "styleM"=>"",
        "styleB"=>"",
        "styleL"=>"",
        "styleD"=>""
    ];
    $navBottomContain='
    <h1>This is administrator menu </h1>
    <div class="menu" id="adminMenu">
    <a class="btnMenu" id="addAdminBtn" href="addAdmin.php">
        <p>
            ADD
        </p>
    </a>
    <a href="tabAdmin.php" class="btnMenu" id="listAdminBtn">
        <p>
            LIST
        </p>
    </a>
    <a href="adminModify.php" class="btnMenu" id="modifyAdminBtn">
        <p>
            MODIFY
        </p>
    </a>
    </div>';
    generalyLoad($styleTotal,$navBottomContain);

    
?>