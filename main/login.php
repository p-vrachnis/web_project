<?php

    // Begin a session.
    session_start();
    if(isset(($_POST['submit']))){
        // Set variables.
        $_SESSION['loggedin'] = false;
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $password=md5($password);

        // To prevent mysql injection.
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        // $username = mysql_real_escappe_string($username);
        // $password = mysql_real_escappe_string($password);

        include_once 'connect_db.php';

        // SQL query to check if user data are on the DB.
        $result = mysqli_query($conn, "Select * from `register` where username = '$username'
        and password = '$password'") or die("failed to query database ".mysqli_error($conn));
        // Fetches result as aassociative array.
        $row = mysqli_fetch_array($result);

        // Check if user is loggedin and force url change in address bar.
        if ($row['username'] == $username && $row['password'] == $password){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header ('Location: index.php');
            exit();
            }
        else{
            $_SESSION["msg"]='Wrong Data, try again!';
            header ('Location: main.php');
        }
    }
?>
