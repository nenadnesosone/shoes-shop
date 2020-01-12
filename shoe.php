<?php
    require_once 'config/config.php';
    require_once 'form/shoe/shoe_handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoe Shoes Shop</title>
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
        <div class="form_box">
            <div class="form_header">
                <h2>Shoe Shop</h2>
                <p>Add, Update or Delete Shoe!</p>
            </div>
            <div id="first">
                <form action="shoe.php" method="POST" id="add_shoes" enctype="multipart/form-data">
                    <input id="code_adding" type="text" name="code_adding" placeholder="Add Shoe Code" maxlength="10" value="<?php
                    if (isset($_SESSION['code_adding'])) {
                     echo $_SESSION['code_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code can only contain english characters and numbers", $error_array)) echo "<span style='color:#ff0000;'>Code can only contain english characters and numbers</span><br>"; ?>
                    <?php if (in_array("Code exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code exists in the database</span><br>"; ?>

                    <input id="shoe_adding" type="text" name="shoe_adding" placeholder="Add Shoe Name" maxlength="50" value="<?php
                    if (isset($_SESSION['shoe_adding'])) {
                     echo $_SESSION['shoe_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Shoe name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Shoe name must be between 2 and 50 characters</span><br>"; ?>

                    <input id="desc_adding" type="text" name="desc_adding" placeholder="Add Shoe Description" maxlength="200" value="<?php
                    if (isset($_SESSION['desc_adding'])) {
                     echo $_SESSION['desc_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Shoe description must be between 2 and 200 characters", $error_array)) echo "<span style='color:#ff0000;'>Shoe description must be between 2 and 50 characters</span><br>"; ?>
                                                                                                                        
                    <input id="price_adding" type="number" name="price_adding" placeholder="Add Shoe Price" min="1" max="100000" value="<?php
                    if (isset($_SESSION['price_adding'])) {
                     echo $_SESSION['price_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Price can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Price can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Price must be between 1 and 100000", $error_array)) echo "<span style='color:#ff0000;'>Price must be between 1 and 100000</span><br>"; ?>

                    <input id="size_adding" type="number" name="size_adding" placeholder="Add Shoe Size" min="1" max="99" value="<?php
                    if (isset($_SESSION['size_adding'])) {
                     echo $_SESSION['size_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Size can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Size can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Size must be between 1 and 99", $error_array)) echo "<span style='color:#ff0000;'>Size must be between 1 and 99</span><br>"; ?>

                    <input id="cat_shoe_adding" type="text" name="cat_shoe_adding" placeholder="Category Name" maxlength="50" value="<?php
                    if (isset($_SESSION['cat_shoe_adding'])) {
                     echo $_SESSION['cat_shoe_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Category name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Category name must be between 2 and 50 characters</span><br>"; ?>
                    <?php if (in_array("Category name doesn't exist in the database", $error_array)) echo "<span style='color:#ff0000;'>Category name doesn't exist in the database</span><br>"; ?>
                   

                    <p>Add Shoe Image!</p>
                    <input id="shoe_image" type="file" name="shoe_image" required>
                    <br><br>

                    <?php if (in_array("Your image is too large!", $error_array)) echo  "<span style='color:#ff0000;'>Your image is too large!</span><br>";
                        else if (in_array("Extention must be JPEG, PNG or JPG!", $error_array)) echo "<span style='color:#ff0000;'>Extention must be JPEG, PNG or JPG!</span><br>";
                    ?>

                    <div style="color:red" class="errorMessageAdd" id="errorMessageAdd"> </div>

                    <input id="add_shoe" type="submit" name="add_shoe" value="Add" disabled>
                    <br>
                    <?php if (in_array("You have added new shoe!", $error_array)) echo "<span style='color:#14C800;'>You have added new shoe!</span><br>"; ?>
                    <a href="#" id="update" class="update">You want to update or delete shoe?</a>

                </form>
            </div>
            <div id="second">

                <form action="shoe.php" method="POST" id="change_shoe" enctype="multipart/form-data">
                    <input id="code_change" type="text" name="code_change" placeholder="Shoe Code" maxlength="10" value="<?php
                    if (isset($_SESSION['code_change'])) {
                     echo $_SESSION['code_change'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Code must have 10 characters", $error_array)) echo "<span style='color:#ff0000;'>Code must have 10 characters</span><br>"; ?>
                    <?php if (in_array("Code doesn't exists in the database", $error_array)) echo "<span style='color:#ff0000;'>Code doesn't exists in the database</span><br>"; ?>

                    <input id="shoe_new" type="text" name="shoe_new" placeholder="New Shoe Name" maxlength="50" value="<?php
                    if (isset($_SESSION['shoe_new'])) {
                     echo $_SESSION['shoe_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Shoe name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Shoe name must be between 2 and 50 characters</span><br>"; ?>

                    <input id="desc_new" type="text" name="desc_new" placeholder="New Shoe Description" maxlength="200" value="<?php
                    if (isset($_SESSION['desc_new'])) {
                     echo $_SESSION['desc_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Shoe description must be between 2 and 200 characters", $error_array)) echo "<span style='color:#ff0000;'>Shoe description must be between 2 and 50 characters</span><br>"; ?>

                    <input id="price_new" type="number" name="price_new" placeholder="New Shoe Price" min="1" max="100000" value="<?php
                    if (isset($_SESSION['price_new'])) {
                     echo $_SESSION['price_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Price can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Price can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Shoe price must be between 1 and 100000", $error_array)) echo "<span style='color:#ff0000;'>Shoe price must be between 1 and 100000</span><br>"; ?>

                    <input id="size_new" type="number" name="size_new" placeholder="New Shoe Size" min="1" max="99" value="<?php
                    if (isset($_SESSION['size_new'])) {
                     echo $_SESSION['size_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Size can only contain numbers", $error_array)) echo "<span style='color:#ff0000;'>Size can only contain numbers</span><br>"; ?>
                    <?php if (in_array("Shoe size must be between 1 and 99", $error_array)) echo "<span style='color:#ff0000;'>Shoe size must be between 1 and 99</span><br>"; ?>

                    <input id="cat_shoe_new" type="text" name="cat_shoe_new" placeholder="New Category Name" maxlength="50" value="<?php
                    if (isset($_SESSION['cat_shoe_new'])) {
                     echo $_SESSION['cat_shoe_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Category name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Category name must be between 2 and 50 characters</span><br>"; ?>
                    <?php if (in_array("Category name doesn't exist in the database", $error_array)) echo "<span style='color:#ff0000;'>Category name doesn't exist in the database</span><br>"; ?>

                    <p>Add New Shoe Image?</p>
                    <input id="image_new" type="file" name="image_new">
                    <br><br>

                    <?php if (in_array("Your image is too large!", $error_array)) echo  "Your image is to large!<br>";
                        else if (in_array("Extention must be JPEG, PNG or JPG!", $error_array)) echo "Extention must be JPEG, PNG or JPG!<br>";
                    ?>
                   
                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>
                                   
                    <input id="update_shoe" type="submit" name="update_shoe" value="Update" disabled>
                    <input id="delete_shoe" type="submit" name="delete_shoe" value="Delete" disabled>
                    <br>
                    <?php if (in_array("You have updated shoe name!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe name!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe description!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe description!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe price!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe price!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe size!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe size!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe category!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe size!</span><br>"; ?>
                    <?php if (in_array("You have updated shoe image!", $error_array)) echo "<span style='color:#14C800;'>You have updated shoe image!</span><br>"; ?>
                    <?php if (in_array("You have deleted shoe!", $error_array)) echo "<span style='color:#14C800;'>You have deleted shoe!</span><br>"; ?>
                    <a href="#" id="add" class="add">You want to add shoe?</a>
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
