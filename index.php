<?php
session_start();
echo "<link rel='shortcut icon' href='../images/favicon.ico' type='image/x-icon' />\n";
if(isset($_SESSION['login_user'])){
   header ('Location: ../user/home.php');
}else{
  require( dirname( __FILE__ ) . '/main/main.php' );
}
?>
