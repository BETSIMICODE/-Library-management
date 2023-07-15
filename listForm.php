<?php
    require_once "securing.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Gestion bibliothèque</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/list.css">  

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
            <?php echo $form;?>
            
        </div>


    </div>

				
</body>

</html>