<?php
session_start();

if(isset($_SESSION['login_user'])){
   header ('Location: ../home/page.php');
}else{
  require( dirname( __FILE__ ) . '/main/main.php' );
}
?>
