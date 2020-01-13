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
                                <th>Shoe Id</th><th>Code</th><th>Shoe Name</th><th>Description</th><th>Price In Dinars</th><th>Size</th><th>Category</th><th>Image</th><th>Created By</th><th>Created At</th><th>Updated By</th><th>Updated At</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
</div>


    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
            url: 'http://localhost/shoes-shop/shoes',
            contentType: 'json',
            method: 'GET',
            success: function(data) {
                    $("#allShoes").dataTable({
                        data: data,
                        columns: [
                            {'data': 'shoe_id'},
                            {'data': 'code'},
                            {'data': 'shoe_name'},
                            {'data': 'description'},
                            {'data': 'price',
                                'render': function (data) {
                                    return  + data + ',00';
                                    }
                            },
                            {'data': 'size'},
                            {'data': 'category_id'},
                            {'data': 'image',
                                'render': function (data) {
                                    return '<img alt="no_image" src="' + data + '" "width="100" height="100" id="image"/>';
                                    }
                            },
                            {'data': 'created_by'},
                            {'data': 'created_at'},
                            {'data': 'updated_by'},
                            {'data': 'updated_at'}
                        ]
                       

                    });

                }
        })
    });

    </script>


    <script src="js/main.js" type="text/javascript"></script>

    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>