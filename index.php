<?php
session_start();
if(isset($_SESSION['login_user'])){
   header ('Location: ../user/home.php');
}else{
  require( dirname( __FILE__ ) . '/main/main.php' );
}
?>
