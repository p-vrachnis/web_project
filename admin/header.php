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
        <a class="logo" href="./home.php"><img src= "../images/logo.png">Welcome <?php echo $username ?></a>
        <div id="header-right">
          <a href="./home.php">Home</a>
          <a href="./about.php">About</a>
          <a href='../main/logout.php'>Logout</a>
        </div>
        <div id="mySidepanel" class="sidepanel">
          <b href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</b>
          <a href="./home.php">Home</a>
          <a href="./about.php">About</a>
          <a href='../main/logout.php'>Logout</a>
        </div>
        <button class="openbtn" onclick="openNav()">&#9776;</button>
      </div>

  <script>
  //makes active button blue
  $(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
     $("#header-right a").each(function(){
          if($(this).attr("href") == "./"+pgurl+".php" )
          $(this).addClass("active");
     })
     $("#mySidepanel a").each(function(){
          if($(this).attr("href") == "./"+pgurl+".php" )
          $(this).addClass("active");
     })
   });

   function openNav() {
  document.getElementById("mySidepanel").style.width = "140px";
}

/* Set the width of the sidebar to 0 (hide it) */
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
  </script>
</body>
</html>
