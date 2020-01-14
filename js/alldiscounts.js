$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/shoes-shop/discounts',
        contentType: 'json',
        method: 'GET',
        success: function(data) {
                $("#allDiscounts").dataTable({
                    data: data,
                    columns: [
                        {'data': 'discount_id'},
                        {'data': 'discount_name'},
                        {'data': 'start_date'},
                        {'data': 'end_date'},
                        {'data': 'shoe_1'},
                        {'data': 'shoe_2'},
                        {'data': 'price',
                        'render': function (data) {
                            return  + data + ',00';
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