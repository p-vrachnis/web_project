
<?php
session_start();
$_SESSION['loggedin']=false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<img src="background.jpg"></img>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="registration.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">

</head>

<body>
<img src="background.jpg"></img>
    <div class="hero">
        <div id="top-header">
            <p>Welcome to the crowdsourcing system!</p>
        </div>
        <div class="form-box" id="box-2">
            <i class="fa fa-users fa-5x" id="fa-users"></i>
            <ul class="entry-list">
                <li>If you are already registered, please login to enter to our system.</li>
                <li>If you are a new member, please press "Register" and enter your data. After that you have to logged in.</li>
            </ul>
        </div>
        <div class="form-box" id="box-1">
            <div class="button-box">
                <div class="btn-group btn-group-justified">
                <button type="button" class="btn btn-primary" onclick="login()" >Log In</button>
                <button type="button" class="btn btn-primary" onclick="register()">Register</button>
                </div>
            </div>
            <form id="login" class="input-group" name="login_form" action="login.php" method="POST">
                <div class="input-group">
                    <i class="fa fa-user fa-2x"></i>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" >
                </div>
                <div class="input-group">
                    <i class="fa fa-lock fa-2x"></i>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button id="btnLogin" type="submit" name="submit" class="btn btn-success btn-lg">Log in</button>
            </form>
            <form id="register" class="input-group" name="register_form" action="register.php" method="POST">
                <div class="input-group">
                    <i class="fa fa-user fa-2x"></i>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="input-group">
                    <i class="fa fa-lock fa-2x"></i>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="input-group">
                    <i class="fa fa-envelope fa-lg"></i>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" >
                </div>
                <div>
                    <input type="checkbox" name="agree" id="agree" value="agree" /> <label for='agree'>Do you agree to the terms?</label>
                </div>
                <button id="btnRegister" type="submit" name="submit" class="btn btn-success btn-lg">Register</button>
            </form>
        </div>
    </div>

    <script src="registration.js"></script>
    <!--Show Error/Success Message (Register/Log In) | jQuery-->
    <script>
        $(document).ready(function(){
            $("#btnRegister").click(function(){
                alert("<?php
                    if(isset($_SESSION["msg"])){
                        $msg = $_SESSION["msg"];
                        echo $msg;
                    }
                ?>");
            });
        });

        $(document).ready(function(){
            $("#btnLogin").click(function(){
                alert("<?php
                    if(isset($_SESSION["msg"])){
                        $msg = $_SESSION["msg"];
                        echo $msg;
                    }
                ?>");
            });
        });
    </script>
</body>
</html>
