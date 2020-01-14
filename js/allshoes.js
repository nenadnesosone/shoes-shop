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
                    {'data': 'updated_at'},
                    {'data': 'deleted_by'},
                    {'data': 'deleted_at'}
                ]
               

            });

        }
    })
});