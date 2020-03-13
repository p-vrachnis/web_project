<?php
  include "../session.php";
  $username = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div class="design">
      <div class="header">
        <a class="logo" href="./home.php"><img src= "../images/logo.png">Welcome user <?php echo $username ?></a>
        <div class="header-right">
          <a class="active" href="./home.php">Home</a>
          <a href="./about.php">About</a>
          <a href='./logout.php'>Logout</a>
        </div>
      </div>
      <div class="main_content">
        <div class="user_info">
          <p style="text-align: center">Απεικόνιση στοιχείων χρήστη</p>
        </div>
        <div class="user_analyse">
          <p style="text-align: center">Ανάλυση στοιχείων χρήστη</p>
        </div>
        <div class="data_load">
          <p style="text-align: center">Upload δεδομένων</p>
          <?php include "../test/final.php" ?>
        </div>
      </div>
    </div>
</body>
</html>
