$(document).ready(function() {
    //
    $("#disc_update").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        })
    });
    //
    $("#disc_add").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        })
    });
});