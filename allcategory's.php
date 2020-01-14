<?php
    require_once 'config/config.php';
    require_once 'data/categorydata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Category's</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
                <table class='table table-primary table-bordered table-striped table-hover text-center' id="allCategory">
                    <caption class='text-center'>All Category's:</caption>
                    <thead>
                        <tr>
                            <th>Category Id</th><th>Category Name</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th><th>Deleted By</th><th>Deleted At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="js/allcategory's.js" type="text/javascript"></script>
    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>