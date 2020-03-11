<?php
  session_start();
  $username = $_SESSION['login_user'];
  echo "<link rel='shortcut icon' href='../images/favicon.ico' type='image/x-icon' />\n";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/user/style.css">
</head>

<body>
    <div class="design">
      <div class="header">
        <a class="logo">Welcome user <?php echo $username ?></a>
        <div class="header-right">
          <a class="active" href="/home/page.php">Home</a>
          <a href="#contact">Contact</a>
          <a href="#about">About</a>
          <a href='/user/logout.php'>Logout</a>
        </div>
      </div>
      <div class="white-background">

      </div>
    </div>
</body>
</html>
