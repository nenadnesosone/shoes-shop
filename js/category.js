$(document).ready(function() {
    //
    $("#cat_update").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        })
    });
    //
    $("#cat_add").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        })
    });
});