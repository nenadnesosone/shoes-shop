$(document).ready(function() {

    // prikazuje sve cipele nesortirane
    $("#category").hide();
    $("#shoes_name").hide();
    $("#shoes_price").hide();
    $("#all").show();
    $("#disc").hide();

    // prikazuje sve cipele sortirane po kategoriji
    $("#cat_button").click(function() {
        $("#category").show();
        $("#shoes_name").hide();
        $("#shoes_price").hide();
        $("#all").hide();
        $("#disc").hide();
    });

    // prikazuje sve cipele sortirane po nazivu
    $("#name_button").click(function() {
        $("#category").hide();
        $("#shoes_name").show();
        $("#shoes_price").hide();
        $("#all").hide();
        $("#disc").hide();
    });

    // prikazuje sve cipele sortirane po ceni
    $("#price_button").click(function() {
        $("#category").hide();
        $("#shoes_name").hide();
        $("#shoes_price").show();
        $("#all").hide();
        $("#disc").hide();
    });

    // prikazuje sve cipele nesortirane
    $("#all_button").click(function() {
        $("#category").hide();
        $("#shoes_name").hide();
        $("#shoes_price").hide();
        $("#all").show();
        $("#disc").hide();
    });

    // prikazuje sve rasprodaje
    $("#disc_button").click(function() {
        $("#category").hide();
        $("#shoes_name").hide();
        $("#shoes_price").hide();
        $("#all").hide();
        $("#disc").show();
    });
});