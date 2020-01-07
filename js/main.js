$(document).ready(function() {

    $("#category").hide();
    $("#shoes_name").hide();
    $("#shoes_price").hide();
    $("#all").show();

    
    $("#cat_button").click(function() {
        $("#category").show();
        $("#shoes_name").hide();
        $("#shoes_price").hide();
        $("#all").hide();
    });

    $("#name_button").click(function() {
        $("#category").hide();
        $("#shoes_name").show();
        $("#shoes_price").hide();
        $("#all").hide();
    });
    $("#price_button").click(function() {
        $("#category").hide();
        $("#shoes_name").hide();
        $("#shoes_price").show();
        $("#all").hide();
    });
    $("#all_button").click(function() {
        $("#category").hide();
        $("#shoes_name").hide();
        $("#shoes_price").hide();
        $("#all").show();
    });
});