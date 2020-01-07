<?php
    require_once 'config/config.php';
    require_once 'form/user/register_handler.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register new user</title>
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

    require 'partials/header.php';

    ?>


    <div class="wrapper">
        <div class="form_box">
            <div class="form_header">
                <h2>Shoes Shop</h2>
                <p>Register new user!</p>
            </div>
            <div>

                <form action="register.php" method="POST" id="register">
                    <input id="reg_fname" type="text" name="reg_fname" placeholder="First Name" value="<?php
                    if (isset($_SESSION['reg_fname'])) {
                     echo $_SESSION['reg_fname'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "<span style='color:#ff0000;'>Your first name must be between 2 and 25 characters</span><br>"; ?>

                    <input id="reg_lname" type="text" name="reg_lname" placeholder="Last Name" value="<?php
                    if (isset($_SESSION['reg_lname'])) {
                       echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters", $error_array)) echo  "<span style='color:#ff0000;'>Your last name must be between 2 and 25 characters</span><br>"; ?>

                    <input id="reg_email" type="email" name="reg_email" placeholder="Email" value="<?php
                    if (isset($_SESSION['reg_email'])) {
                     echo $_SESSION['reg_email'];
                    } ?>" required>
                    <br>

                    <input id="reg_email2" type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                    if (isset($_SESSION['reg_email2'])) {
                     echo $_SESSION['reg_email2'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Email already in use", $error_array)) echo  "<span style='color:#ff0000;'>Email already in use</span><br>";
                    else if (in_array("Invalid email format", $error_array)) echo  "<span style='color:#ff0000;'>Invalid email format</span><br>";
                    else if (in_array("Emails don't match", $error_array)) echo  "<span style='color:#ff0000;'>Emails don't match</span><br>"; ?>

                    <select id="reg_type" name="reg_type" required>
                        <option value="worker" selected>worker</option>
                        <option value="admin">admin</option>
                    </select>
                    <br>

                    <?php if (in_array("Please select Authorization type", $error_array)) echo "<span style='color:#ff0000;'>Please select Authorization type</span><br>"; ?>

                    <input id="reg_password" type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input id="reg_password2" type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                
                    <?php if (in_array("Your password do not match", $error_array)) echo "<span style='color:#ff0000;'>Your password do not match</span><br>";
                    else if (in_array("Your password can only contain english characters and numbers", $error_array)) echo  "<span style='color:#ff0000;'>Your password can only contain english characters and numbers</span><br>";
                    else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "<span style='color:#ff0000;'>Your password must be between 5 and 30 characters</span><br>"; ?>
    

                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>
                    <br>                      
                    <input id="register_button" type="submit" name="register_button" value="Register">
                    <br>
                    <?php if (in_array("You're all set! Go ahead and login!", $error_array)) echo "<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
                    <?php if (in_array("You're not admin! New user not added!", $error_array)) echo "<span style='color:#ff0000;'>You're not admin! New user not added!</span><br>"; ?>
                    <br>                     

                </form>
            </div>
        </div>
    </div>
    <!-- ubaciti skriptu -->
    <script src="js/register.js"></script>


    <?php
        require_once 'partials/footer.php';
    ?>  
</body>

</html>