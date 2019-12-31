<?php

require_once 'config/config.php';
require_once 'form/user/login_handler.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Shoes Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    
    <?php

    require_once 'partials/header.php';

    ?>


    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h2>Shoes Shop</h2>
                <p>Login below!</p>
            </div>
            <div id="first">
                <form action="login.php" method="POST">
                    <input id="log_email" type="email" name="log_email" placeholder="Email" value="<?php
                     if (isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                   } ?>" required>
                    <br>
                    <input id="log_password" type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect!<br>", $error_array)) {
                        echo "Email or password was incorrect!<br>";
                    } ?>
                    <br>
                    <input id="login_button" type="submit" name="login_button" value="Login">
                    <br>


                </form>
            </div>
    
        </div>
    </div>

    <!---ubaciti skriptu koja proverava da li je sve ok pre slanja na server--->
    <script src="js/login.js"></script>

    <?php
    require_once 'partials/footer.php';
    ?>  
</body>

</html>