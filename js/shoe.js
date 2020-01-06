$(document).ready(function() {
    //
    $("#shoe_update").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        })
    });
    //
    $("#shoe_add").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        })
    });
});