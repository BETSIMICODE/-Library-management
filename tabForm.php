<?php require_once "securing.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Gestion bibliothèque</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/tab.css">
    


</head>

<body>
    <div class="contenair">
        <div class="navTop">
            <a id="returnBtn" href="<?php echo $hrefReturn;?>">
                Return
            </a>
            <?php echo $mess;?>
        </div>
        <div class="addForm">
            <h1 class="addText">
                <?php echo $title; ?>
            </h1>
            
            <table class="table">
                <tr class="addFormLine">
                    <?php foreach($stub as $x){
                        echo '<th class="columnTitle">'.$x.'</th>'; 
                    }?>
                </tr>
                <?php echo $research; ?>
                <?php foreach($col as $line){
                    echo '<tr class="addFormLine">';
                    foreach($line as $y){if($y==""){$y="-";}echo '<td class="column">'.$y.'</td>';}
                    echo'<td class="column btnColumn" ><div class="btnContainer"><button class="btnMore btnMoreClick" data-ident="'.$line[$identification].'">  More </button></div></td>';
                    echo'</tr>';
                }
                    echo $script;
                ?>

            </table>
            
        </div>


    </div>

				
</body>

</html>