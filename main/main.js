// Change box-1 between LogIn & Register
$(function () {
    $("#register_btn").click(function () {
        $("#register").show();
        $("#login").hide();
    });
});

$(function () {
    $("#login_btn").click(function () {
        $("#register").hide();
        $("#login").show();
    });
});
