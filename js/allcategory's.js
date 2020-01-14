$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/shoes-shop/category\'s',
        contentType: 'json',
        method: 'GET',
        success: function(data) {
                $("#allCategory").dataTable({
                    data: data,
                    columns: [
                        {'data': 'category_id'},
                        {'data': 'category_name'},
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