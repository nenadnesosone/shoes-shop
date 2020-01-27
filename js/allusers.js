$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/shoes-shop/users',
        contentType: 'json',
        method: 'GET',
        success: function(data) {
                $("#allUsers").dataTable({
                    data: data,
                    columns: [
                        {data: 'users_id'},
                        {data: 'first_name'},
                        {data: 'last_name'},
                        {data: 'email'},
                        {data: 'password'},
                        {data: 'type'},
                        {data: 'created_by'},
                        {data: 'created_at'},
                        {data: 'updated_by'},
                        {data: 'updated_at'},
                        {data: 'deleted_by'},
                        {data: 'deleted_at'}
                    ]
                });

            }
    })
});