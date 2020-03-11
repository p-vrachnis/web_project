<?php
  include "../session.php";
  $username = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/about.css">
</head>

<body>
    <div class="design">
      <div class="header">
        <a class="logo" href="./home.php"><img src= "../images/logo.png">Welcome user <?php echo $username ?></a>
        <div class="header-right">
          <a href="./home.php">Home</a>
          <a class="active" href="./about.php">About</a>
          <a href='./logout.php'>Logout</a>
        </div>
      </div>
      <div class="main_content">
        <div class = "about">
          <p id="uni_logo"><img src= "../images/uni_logo.png"> </p>
          <div class="about-background">
            <p id="about_box">test text test test test test</p>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
