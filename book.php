<?php
    require_once "securing.php";
    require_once "generalyLoad.php";
    $styleTotal=[
        "styleH"=>"",
        "styleA"=>"",
        "styleM"=>"",
        "styleB"=>$style,
        "styleL"=>"",
        "styleD"=>""
    ];
    $navBottomContain='
    <h1>
    This is the book menu            </h1>
<div class="menu" id="bookMenu">
    <a class="btnMenu" href="addBook.php" id="addBookBtn">
        <p>
            ADD
        </p>
    </a>
    <a href="tabBook.php" class="btnMenu" id="listBookBtn">
        <p>
            LIST
        </p>
    </a>

    <a class="btnMenu" id="listAuthorBtn" href="tabAuthor.php">
        <p>
            AUTHOR
        </p>
    </a>
</div>';
    generalyLoad($styleTotal,$navBottomContain);
?>