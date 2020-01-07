<?php
    require_once 'config/config.php';
    require_once 'data/shoesdata.php';
    require_once 'data/discountdata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoes Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">


</head>

<body>
    <!-- NAV -->
    <?php
        require_once 'partials/header.php';
    ?>

    <div class="container m-auto col-md-6" id="click">
        <div class="row ">
            <input id="cat_button" type="button" name="cat_button" value="Sort By Category" class="btn-primary">
            <input id="name_button" type="button" name="name_button" value="Sort By Name" class="btn-primary">
            <input id="price_button" type="button" name="price_button" value="Sort By Price" class="btn-primary">
            <input id="all_button" type="button" name="all_button" value="All Shoes" class="btn-primary">
            <input id="disc_button" type="button" name="disc_button" value="Discounts"class="btn-primary" >
        </div>
    </div>

    <div class="container m-auto" id="category">
        <div class="row">
                <?php
                    ShoesData::SortShoesCategory();
                ?>
        </div>
    </div>

    <div class="container m-auto" id="shoes_name">
        <div class="row">
                <?php
                    ShoesData::SortShoesName();
                ?>
        </div>
    </div>

    <div class="container m-auto" id="shoes_price">
        <div class="row">
                <?php
                    ShoesData::SortShoesPrice();
                ?>
        </div>
    </div>

    <div class="container m-auto" id="all">
        <div class="row">
                <?php
                    ShoesData::GetAllShoes();
                ?>
        </div>
    </div>

    <div class="container m-auto" id="disc">
        <div class="row">
                <?php
                    DiscountData::GetAllDiscounts();
                ?>
        </div>
    </div>

    <script src="js/main.js" type="text/javascript"></script>

    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>