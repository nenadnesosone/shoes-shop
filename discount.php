<?php
    require_once 'config/config.php';
    require_once 'form/discount/discount_handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discount Shoes Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

</head>

<body>  
    <?php
        if (isset($_POST['update_disc']) || isset($_POST['delete_disc'])) {
            echo '
                <script>
                $(document).ready(function() {
                    $("#first").hide();
                    $("#second").show();
                });
                </script>
            ';
        }
    ?>

    
    <?php
        require_once 'partials/header.php';
    ?>


    <div class="wrapper">
        <div class="form_box">
            <div class="form_header">
                <h2>Shoe Shop</h2>
                <p>Add, Update or Delete Discount!</p>
            </div>
            <div id="first">
                <form action="discount.php" method="POST" id="disc_add">
             
                    <input id="disc_adding" type="text" name="disc_adding" placeholder="Add Discount Name" maxlength="50" value="<?php
                    if (isset($_SESSION['disc_adding'])) {
                     echo $_SESSION['disc_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Discount name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Discount name must be between 2 and 50 characters</span><br>"; ?>

                    <label for="start_adding">Start Date</label><br>
                    <input id="start_adding" type="date" name="start_adding" value="<?php
                    if (isset($_SESSION['start_adding'])) {
                     echo $_SESSION['start_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Invalid date", $error_array)) echo "<span style='color:#ff0000;'>Invalid date</span><br>"; ?>
                    <?php if (in_array("Start discount date can't start before today", $error_array)) echo "<span style='color:#ff0000;'>Start discount date can't start before today</span><br>"; ?>
                              
                    <label for="end_adding">End Date</label><br>
                    <input id="end_adding" type="date" name="end_adding" value="<?php
                    if (isset($_SESSION['end_adding'])) {
                     echo $_SESSION['end_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Invalid date", $error_array)) echo "<span style='color:#ff0000;'>Invalid date</span><br>"; ?>
                    <?php if (in_array("End discount date can't be before start discount date", $error_array)) echo "<span style='color:#ff0000;'>End discount date can't be before start discount date</span><br>"; ?>

                    <input id="shoe_1_adding" type="text" name="shoe_1_adding" placeholder="Add Shoe 1 Code" maxlength="10" value="<?php
                    if (isset($_SESSION['shoe_1_adding'])) {
                     echo $_SESSION['shoe_1_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code can only contain english characters and numbers", $error_array)) echo "<span style='color:#ff0000;'>Code can only contain english characters and numbers</span><br>"; ?>
                    <?php if (in_array("Code doesn't exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code doesn't exists in the database</span><br>"; ?>

                    <!--da mogu dva razlicita ili ista para da udju u rasprodaju-->
                    <input id="shoe_2_adding" type="text" name="shoe_2_adding" placeholder="Add Shoe 2 Code" maxlength="10" value="<?php
                    if (isset($_SESSION['shoe_2_adding'])) {
                     echo $_SESSION['shoe_2_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code can only contain english characters and numbers", $error_array)) echo "<span style='color:#ff0000;'>Code can only contain english characters and numbers</span><br>"; ?>
                    <?php if (in_array("Code doesn't exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code doesn't exists in the database</span><br>"; ?>
                    
                    <input id="disc_price_adding" type="number" name="disc_price_adding" placeholder="Add Discount Price" min="1" max="100000" value="<?php
                    if (isset($_SESSION['disc_price_adding'])) {
                     echo $_SESSION['disc_price_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Price can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Price can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Price must be between 1 and 100000", $error_array)) echo "<span style='color:#ff0000;'>Price must be between 1 and 100000</span><br>"; ?>

                    <div style="color:red" class="errorMessageAdd" id="errorMessageAdd"> </div>

                    <input id="add_disc" type="submit" name="add_disc" value="Add" disabled>
                    <br>
                    <?php if (in_array("You have added new discount!", $error_array)) echo "<span style='color:#14C800;'>You have added new discount!</span><br>"; ?>
                    <a href="#" id="update" class="update">You want to update or delete discount?</a>

                </form>
            </div>
            <div id="second">

                <form action="discount.php" method="POST" id="change_disc">
                    <input id="disc_id_new" type="number" name="disc_id_new" placeholder="Discount Id" min="1" value="<?php
                    if (isset($_SESSION['disc_id_new'])) {
                     echo $_SESSION['disc_id_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Discount id can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Discount id can only contain numbers</span><br>"; ?>
                    

                    <input id="disc_new" type="text" name="disc_new" placeholder="New Discount Name" maxlength="50" value="<?php
                    if (isset($_SESSION['disc_new'])) {
                     echo $_SESSION['disc_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Discount name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Discount name must be between 2 and 50 characters</span><br>"; ?>

                    <label for="start_new">New Start Date</label><br>
                    <input id="start_new" type="date" name="start_new" value="<?php
                    if (isset($_SESSION['start_new'])) {
                     echo $_SESSION['start_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Invalid date", $error_array)) echo "<span style='color:#ff0000;'>Invalid date</span><br>"; ?>
                    <?php if (in_array("Start discount date can't be before today", $error_array)) echo "<span style='color:#ff0000;'>Start discount date can't be before today</span><br>"; ?>

                    <label for="end_new">New End Date</label><br>
                    <input id="end_new" type="date" name="end_new" value="<?php
                    if (isset($_SESSION['end_new'])) {
                     echo $_SESSION['end_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Invalid date", $error_array)) echo "<span style='color:#ff0000;'>Invalid date</span><br>"; ?>
                    <?php if (in_array("End discount date can't be before today", $error_array)) echo "<span style='color:#ff0000;'>Start discount date can't be before today</span><br>"; ?>
                    <?php if (in_array("End discount date can't be before start date", $error_array)) echo "<span style='color:#ff0000;'>End discount date can't be before start date</span><br>"; ?>

                    <input id="shoe_1_new" type="text" name="shoe_1_new" placeholder="New Shoe 1 Code" maxlength="10" value="<?php
                    if (isset($_SESSION['shoe_1_new'])) {
                     echo $_SESSION['shoe_1_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code can only contain english characters and numbers", $error_array)) echo "<span style='color:#ff0000;'>Code can only contain english characters and numbers</span><br>"; ?>
                    <?php if (in_array("Code doesn't exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code doesn't exists in the database</span><br>"; ?>
                  
                    <input id="shoe_2_new" type="text" name="shoe_2_new" placeholder="New Shoe 2 Code" maxlength="10" value="<?php
                    if (isset($_SESSION['shoe_2_new'])) {
                     echo $_SESSION['shoe_2_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code can only contain english characters and numbers", $error_array)) echo "<span style='color:#ff0000;'>Code can only contain english characters and numbers</span><br>"; ?>
                    <?php if (in_array("Code doesn't exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code doesn't exists in the database</span><br>"; ?>

                    <input id="disc_price_new" type="number" name="disc_price_new" placeholder="New Discount Price" min="1" max="100000" value="<?php
                    if (isset($_SESSION['disc_price_new'])) {
                     echo $_SESSION['disc_price_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Price can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Price can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Price must be between 1 and 100000", $error_array)) echo "<span style='color:#ff0000;'>Price must be between 1 and 100000</span><br>"; ?>
                   
                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>
                                   
                    <input id="update_disc" type="submit" name="update_disc" value="Update" disabled>
                    <input id="delete_disc" type="submit" name="delete_disc" value="Delete" disabled>
                    <br>
                    <?php if (in_array("You have updated discount name!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount name!</span><br>"; ?>
                    <?php if (in_array("You have updated discount start date!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount start date!</span><br>"; ?>
                    <?php if (in_array("You have updated discount end date!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount end date!</span><br>"; ?>
                    <?php if (in_array("You have updated discount shoe 1!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount shoe 1!</span><br>"; ?>
                    <?php if (in_array("You have updated discount shoe 2!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount shoe 2!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe image!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe image!</span><br>"; ?>
                    <?php if (in_array("You have updated discount price!", $error_array)) echo "<span style='color:#14C800;'>You have updated discount price!</span><br>"; ?>
                    <?php if (in_array("You have deleted discount!", $error_array)) echo "<span style='color:#14C800;'>You have deleted discount!</span><br>"; ?>
                    <a href="#" id="add" class="add">You want to add discount?</a>
                    <br>                     

                </form>
            </div>
        </div>
    </div>

        <!--ubaciti proveru u js -->
    <script src="js/form.js"></script>

    <?php
        require_once 'partials/footer.php';
    ?>   
</body>