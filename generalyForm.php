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
    <link rel="stylesheet" href="./css/home.css">  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>
    <div class="contenair">
        <div class="navTop">
            <a href="./home.php" style="<?php echo $styleH; ?>" id="hBtn">
                HOME
            </a>
            <a href="./admin.php" style="<?php echo $styleA; ?>" id="aBtn">
                ADMIN
            </a>
            <a href="./book.php" style="<?php echo $styleB; ?>"  id="bBtn">
                BOOK

            </a>
            <a href="./loan.php" style="<?php echo $styleL; ?>"  id="lBtn">
                LOAN

            </a>
            <a href="./member.php" style="<?php echo $styleM; ?>"  id="mBtn">
                MEMBER
            </a>
            <a href="./deconnection.php" style="<?php echo $styleD; ?>"  id="dBtn">
                DISCONNECT
            </a>
        </div>
        <div class="navBottom">
            <?php echo $navBottomContain; ?>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"> </script>
    <script src="./js/srcipt.js"> </script>		
</body>

</html>