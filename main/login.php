<?php
    // Begin a session.
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
      include_once '../connect_db.php';
      // Set variables.
      $username = filter_input(INPUT_POST, 'username');
      $password = filter_input(INPUT_POST, 'password');
      //$password=md5($password);

      // To prevent mysql injection.
      //$username = stripcslashes($username);
      //$password = stripcslashes($password);

      // SQL query to check if user data are on the DB.
      $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
        $_SESSION['login_user'] = $username;
        header ('Location: ../home/page.php');
      }else{
        header ('Location: ../index.php');
      }
    }
?>
