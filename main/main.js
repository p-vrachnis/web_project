// Change box-1 between LogIn & Register
var x = document.getElementById("login");
var y = document.getElementById("register");

function register(){
    x.style.left = "-1000px";
    y.style.left = "0px";
    x.style.visibility = "hidden";
    y.style.visibility = "visible";
}

function login(){
    x.style.left = "0px";
    y.style.left = "1000px";
    y.style.visibility = "hidden";
    x.style.visibility = "visible";

}
