<?php
    require_once 'config/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoes Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <link rel="stylesheet" href="css/main.css">


</head>

<body>
    <!-- NAV -->
    <?php
        require_once 'partials/header.php';
    ?>
    <div class="container m-auto">
            <div class="row">
                <div class='table-responsive'>
                        <table class="table table-primary table-bordered table-striped table-hover text-center dataTable" id="allShoes">
                            <caption class='text-center'>All Shoes:</caption>
                            <thead>
                                <tr>
                                    <th>Code</th><th>Shoe Name</th><th>Description</th><th>Price In Dinars</th><th>Size</th><th>Category</th><th>Image</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
    </div>

    <script src="js/main.js" type="text/javascript"></script>

    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>