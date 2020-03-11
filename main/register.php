<?php

    // Begin session.
    session_start();

    // Check if button submit is set to give access to the DB.
    if($_SERVER['REQUEST_METHOD'] == "POST") {
      include_once '../connect_db.php';
        //  Grab a Form data and store it in variables.
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $email = filter_input(INPUT_POST, 'email');
        $agree = filter_input(INPUT_POST, 'agree');

        // Check if username or email field is empty.
        if (!isset($username) || trim($username) || !isset($email)){
            // Check if user has given the right value in the password field.
            if (preg_match("/^(?=.*\d)(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$$/", $_POST['password'])){
                // Check if terms field is checked.
                if(!empty($_POST['agree']) || $_POST['agree'] == 'agree'){
                    // Check if the connection to the DB is valid.
                    if (mysqli_connect_error()){
                        // Returns the error description of the connection error and close connection.
                        die('Connect Error ('. mysqli_connect_errno() .') '
                        . mysqli_connect_error());
                    }
                    else{
                        // MD5 hash of the password.
                        $password = md5($password);

                        // Two-way encryption of userID.
                        $key = $password;
                        $plaintext = $email;
                        $cipher = "AES-256-CBC";
                        $id = openssl_encrypt($plaintext, $cipher, $key);

                        // SQL Insert Query of the data.
                        $sql = "INSERT INTO users (userID, username, password, email)
                        values ('$id','$username','$password','$email')";
                        // Check connection to the DB.
                        if ($conn->query($sql)){
                            $_SESSION["msg"]='You are successully registered!
                                              Now you Have to Log in.';
                            // Force url change in address bar.
                            header ('Location: ../index.php');
                        }
                        else{
                            echo "Error: ". $sql ."
                            ". $conn->error;
                        }
                        $conn->close();
                    }
                }
                else{
                    $_SESSION["msg"]='You have to agree with the terms!';
                    header ('Location: ../index.php');
                }
            }
            else{
                $_SESSION["msg"]='Your password must be 8 chars with at least a number and a symbol(#$*&@)!';
                header ('Location: ../index.php');
            }
        }
        else{
            $_SESSION["msg"]='Your username or email or both is invalid!';
            header ('Location: ../index.php');
        }
    }
?>
