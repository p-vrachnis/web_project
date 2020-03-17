<?php
  session_start();
  $username = $_SESSION['login_user'];
  $data = json_decode($_POST['data']);
  // SQL Insert Query of the data.
  include_once '../external/connect_db.php';
  for( $index = 0; $index < sizeof($data); $index++ ){
    $timestampMs = $data[$index][0];
    $latitudeE7 = $data[$index][1];
    $longitudeE7 = $data[$index][2];
    $activity = $data[$index][3];

    $sql = "INSERT INTO user_data (username, timestampMs, latitudeE7, longitudeE7, activity)
            values ('$username','$timestampMs','$latitudeE7','$longitudeE7','$activity')";
    if (mysqli_query($conn, $sql)) {
     echo "New record created successfully";
    } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

?>
