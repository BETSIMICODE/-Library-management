<?php
require_once "securing.php";
    require_once "generalyLoad.php";
    $styleTotal=[
        "styleH"=>"",
        "styleA"=>"",
        "styleM"=>"",
        "styleB"=>"",
        "styleL"=>"",
        "styleD"=>$style
    ];
    $navBottomContain='
    <br>
    <form class="discoForm" action="disconnectLoad.php">
        <button id="logoutBtn" class="btnMenu" onclick="disconnect()"   formaction="disconnectLoad.php"> Logout</button>
    </form>
    <script>
        function disconnect() {
            if(confirm("Are you really sure to disconnect?")){
                document.getElementById("logoutBtn").setAttribute("formaction", "disconnectLoad.php");    
                document.getElementById("logoutBtn").submit(); 
            }else{event.preventDefault();}
            }
    </script>
    <br>
        
        ';
    generalyLoad($styleTotal,$navBottomContain);
?>