<?php
   session_start();

   if(isset($_SESSION['login_user'])){
      header ('Location: ../home/page.php');
   }else{
     header("location:../index.php");
   }
?>
