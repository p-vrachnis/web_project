/* SHOW/HIDE confirmation of deletion */
$(function () {
    $("#delete").click(function () {
        $("#del-conf").show();
    });
});

$(function () {
    $("#delete-neg").click(function () {
        $("#del-conf").hide();
    });
});