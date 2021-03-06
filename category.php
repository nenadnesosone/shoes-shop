<?php
    require_once 'config/config.php';
    require_once 'form/category/category_handler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Shoes Shop</title>
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
        if (isset($_POST['update_category']) || isset($_POST['delete_category'])) {
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
                <p>Add, Update or Delete Category!</p>
            </div>
            <div id="first">
                <form action="category.php" method="POST" id="add_categorys">
                    <input id="cat_adding" type="text" name="cat_adding" placeholder="Add New Category Name" maxlength="50" value="<?php
                    if (isset($_SESSION['cat_adding'])) {
                     echo $_SESSION['cat_adding'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Category name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Category name must be between 2 and 50 characters</span><br>"; ?>
                    <?php if (in_array("Category name exist in the database", $error_array)) echo "<span style='color:#ff0000;'>Category name exist in the database</span><br>"; ?>

                    <div style="color:red" class="errorMessageAdd" id="errorMessageAdd"> </div>

                    <input id="add_category" type="submit" name="add_category" value="Add" disabled>
                    <br>
                    <?php if (in_array("You have added new category!", $error_array)) echo "<span style='color:#14C800;'>You have added new category!</span><br>"; ?>
                    <a href="#" id="update" class="update">You want to update or delete category?</a>

                </form>
            </div>
            <div id="second">

                <form action="category.php" method="POST" id="change_category">
                    <input id="cat_present" type="text" name="cat_present" placeholder="Present Category Name" maxlength="50" value="<?php
                    if (isset($_SESSION['cat_present'])) {
                     echo $_SESSION['cat_present'];
                    } ?>" required>
                    <br>
                    <input id="cat_new" type="text" name="cat_new" placeholder="New Category Name" maxlength="50" value="<?php
                    if (isset($_SESSION['cat_new'])) {
                     echo $_SESSION['cat_new'];
                    } ?>">
                    <br>
                    <?php if (in_array("Category name doesn't exist in the database", $error_array)) echo "<span style='color:#ff0000;'>Category name doesn't exist in the database</span><br>"; ?>
                    <?php if (in_array("Category name must be between 2 and 50 characters", $error_array)) echo "<span style='color:#ff0000;'>Category name must be between 2 and 50 characters</span><br>"; ?>

                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>
                                   
                    <input id="update_category" type="submit" name="update_category" value="Update" disabled>
                    <input id="delete_category" type="submit" name="delete_category" value="Delete" disabled>
                    <br>
                    <?php if (in_array("You have updated category!", $error_array)) echo "<span style='color:#14C800;'>You have updated category!</span><br>"; ?>
                    <?php if (in_array("You have deleted category!", $error_array)) echo "<span style='color:#14C800;'>You have deleted category!</span><br>"; ?>
                    <a href="#" id="add" class="add">You want to add category?</a>
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

</html>