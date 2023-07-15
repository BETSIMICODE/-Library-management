<!DOCTYPE html>
<html lang="en">

<head>

    <title>Gestion bibliothèque</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">  

</head>

<body>
    <div class="background">
        <!-- <div class="shape"></div>
        <div class="shape"></div> -->
    </div>
    <form method="get" action="login.php" >
        <h3>Login </h3>
            <label for="username">Email</label>
            <input name="mail_input" type="text" placeholder="Email" id="username">
            <label  for="password">Password</label>
            <input name="passwd_input" type="password" placeholder="Password" id="password">

            <button>
                <span></span>
                <span></span>
                <span></span>
                <span></span>Log In</button>
            <div class="social">
                

            <!-- <div class="go"><i class="fab fa-google"></i> Google</div>
            <div class="fb"><i class="fab fa-facebook"></i> Facebook</div> -->
            </div>
            <?php
                echo '<p style="text-align:center; color:red; font-weight: 500">'.$varErr.'</p>';
            ?>
    </form>
</body>

</html>