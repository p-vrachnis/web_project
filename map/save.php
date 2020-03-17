<?php
  session_start();
  $username = $_SESSION['login_user'];
  $data = json_decode($_POST['data']);
  // SQL Insert Query of the data.
  include_once '../external/connect_db.php';
  $sql = "REPLACE INTO user_data (username, timestampMs, latitudeE7, longitudeE7, activity) values";
  for( $index = 0; $index < sizeof($data); $index++ ){
    $timestampMs = $data[$index][0];
    $latitudeE7 = $data[$index][1];
    $longitudeE7 = $data[$index][2];
    $activity = $data[$index][3];

    $sql = $sql."('$username','$timestampMs',$latitudeE7,$longitudeE7,'$activity'),";
  }
  $sql = substr($sql, 0, -1);
  $sql = $sql.";";
  if (mysqli_query($conn, $sql)) {
   echo "Markers saved successfully";
  } else {
   echo "Error: " . mysqli_error($conn);
  }

?>
