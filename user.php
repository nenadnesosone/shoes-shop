<?php
    require_once 'config/config.php';
    require_once 'form/user/user_handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update or Delete user</title>
    </title>
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

        if (isset($_POST['delete_button'])) {
            header('Location: main.php');
        }

        require_once 'partials/header.php';
    ?>



    <div class="wrapper">
        <div class="form_box">
            <div class="form_header">
                <h2>Shoe Shop</h2>
                <p>Here you can update or delete user!</p>
            </div>

            <div id="first">
                <form action="user.php" method="POST" enctype="multipart/form-data">
                   
                    <input id="profile_password" type="password" name="profile_password" placeholder="Password" required>
                    <br>
                    <?php if (in_array("Password was incorrect!", $error_array)) {
                        echo "<span style='color:#ff0000;'>Password was incorrect!</span><br";
                    } ?>
                    <br>
                    
                    <input id="update_fname" type="text" name="update_fname" placeholder="New First Name" value="<?php
                        if (isset($_SESSION['update_fname'])) {
                            echo $_SESSION['update_fname'];
                        } ?>">
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "<span style='color:#ff0000;'>Your first name must be between 2 and 25 characters</span><br>"; ?>

                    <input id="update_lname" type="text" name="update_lname" placeholder="New Last Name" value="<?php
                        if (isset($_SESSION['update_lname'])) {
                            echo $_SESSION['update_lname'];
                        } ?>">
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters", $error_array)) echo  "<span style='color:#ff0000;'>Your last name must be between 2 and 25 characters</span><br>"; ?>

                    <select id="update_type" name="update_type">
                        <option value="worker" selected>worker</option>
                        <option value="admin">admin</option>
                    </select>
                    <br>
                    
                    <?php if (in_array("Please select authorization type", $error_array)) echo "<span style='color:#ff0000;'>Please select authorization type</span><br>"; ?>

                    <input id="new_password" type="password" name="new_password" placeholder="New Password">
                    <br>
                    <input id="new_password2" type="password" name="new_password2" placeholder="Confirm New Password">
                    <br>

                    <?php if (in_array("Passwords don't match", $error_array)) echo "<span style='color:#ff0000;'>Passwords don't match</span><br>";
                    else if (in_array("Your password can only contain english characters and numbers", $error_array)) echo  "<span style='color:#ff0000;'>Your password can only contain english characters and numbers</span><br>";
                    else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "<span style='color:#ff0000;'>Your password must be between 5 and 30 characters</span><br>"; ?>

                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>

                    <input id="update_button" type="submit" name="update_button" value="Update" disabled>
                    <input id="delete_button" type="submit" name="delete_button" value="Delete" disabled><br>
                    <?php if (in_array("You have updated your First Name!", $error_array)) echo "<span style='color:#14C800;'>You have updated your First Name!</span><br>"; ?>
                    <?php if (in_array("You have updated your Last Name!", $error_array)) echo "<span style='color:#14C800;'>You have updated your Last Name!</span><br>"; ?>
                    <?php if (in_array("You have updated your Last Name!", $error_array)) echo "<span style='color:#14C800;'>You have updated your Last Name!</span><br>"; ?>
                    <?php if (in_array("You have updated your authorization type!", $error_array)) echo "<span style='color:#14C800;'>You have updated your authorization type!</span><br>"; ?>
          

                </form>
            </div>

        </div>
    </div>
    <!--ubaciti skriptu za proveru pre validacije-->
    <script src="js/form.js"></script>

    <?php
        require_once 'partials/footer.php';
    ?>
</body>

</html>