<?php
    require_once 'config/config.php';
    require_once 'data/usersdata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All User Of Shoes Shop</title>
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
                    <table class='table table-primary table-bordered table-striped table-hover text-center dataTable' id="allUsers">
                        <caption class='text-center'>All Users:</caption>
                        <thead>
                            <tr>
                                <th>User Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Password Hash</th><th>Type</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th><th>Deleted By</th><th>Deleted At</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
    </div>


    <script src="js/allusers.js" type="text/javascript"></script>



    <!-- <div class="container m-auto">
            <div class="row">
                <?php
                UsersData::GetAllUsers();
                ?>
            </div>
    </div> -->


    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>