<?php
session_start();
echo "<link rel='shortcut icon' href='../images/favicon.ico' type='image/x-icon' />\n";
if(!isset($_SESSION['login_user'])){
   header ('Location: ../index.php');
}
if($_SESSION['login_user'] != "admin"){
  header ('Location: ../error/403.php');
}
?>
