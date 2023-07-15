<?php
    require_once "securing.php";
    require_once "generalyLoad.php";
    //file usefull for database'manipulation
    require_once "db-connection.php";
    require_once "queryFunction.php";
    //recuperation admin name
    $admin_name=recupVal($connection,"select admin_name from admin where admin_mail=?",[$_SESSION['user_mail']],"admin_name");
    $styleTotal=[
        "styleH"=>$style,
        "styleA"=>"",
        "styleM"=>"",
        "styleB"=>"",
        "styleL"=>"",
        "styleD"=>""
    ];

    $a=(string)recupVal($connection,"select count(member_id) as test from member where card_year=2020","","test");
    $b=(string)recupVal($connection,"select count(member_id) as test from member where card_year=2021","","test");
    $c=(string)recupVal($connection,"select count(member_id) as test from member where card_year=2022","","test");
    $d=(string)recupVal($connection,"select count(member_id) as test from member where card_year=2023","","test");
    echo $d;
    $navBottomContain='
    <h1>
        Hello '.$admin_name.'!
    </h1>
    <p id="paraHome">
        This is a web application that manages a library. I did it to just train and initiate in php language. It\'s not great, but it\'s still functional.
    </p>
    <div>
        <canvas id="myChart"></canvas>
    </div>


    <script>
        const ctx = document.getElementById(\'myChart\');

        new Chart(ctx, {
            type: \'bar\',
            data: {
            labels: [\'2020\', \'2021\', \'2022\', \'2023\'],
            datasets: [{
            label:\'Member count\',
        
            data: ['.$a.','.$b.','.$c.','.$d.'],
            backgroundColor:["#effaffd0","#effaffd0","#effaffd0","#effaffd0"],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    </script>


    
    
    
    ';
    generalyLoad($styleTotal,$navBottomContain);
?>