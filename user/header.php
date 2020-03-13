<?php
  $username = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
      <div class="header">
        <a class="logo" href="./home.php"><img src= "../images/logo.png">Welcome user <?php echo $username ?></a>
        <div id="header-right">
          <a href="./home.php">Home</a>
          <a href="./about.php">About</a>
          <a href='./logout.php'>Logout</a>
        </div>
      </div>

  <script>
  //makes active button blue
  $(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
     $("#header-right a").each(function(){
          if($(this).attr("href") == "./"+pgurl+".php" )
          $(this).addClass("active");
     })
   });
  </script>
</body>
</html>
