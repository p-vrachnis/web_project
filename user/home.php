<?php
  include "../session.php";
  include "./page.php";
  $username = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Home Page</title>
</head>

<body>
    <div class="design">
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
