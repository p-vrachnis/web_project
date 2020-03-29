<?php

  session_start();
  $username = $_SESSION['login_user'];
  $data = json_decode($_POST['data']);
  // SQL Insert Query of the data.
  include_once '../external/connect_db.php';
  // GET ALL JSON DATA TO DATABASE
  $sql = "REPLACE INTO user_data (username, timestampMs, latitudeE7, longitudeE7, accuracy, altitude, velocity, verticalAccuracy, heading, activity, act_timestampMs, act_confidence) values";
  for( $index = 0; $index < sizeof($data) ; $index++ ){
    $timestampMs = $data[$index][0];
    $latitudeE7 = $data[$index][1];
    $longitudeE7 = $data[$index][2];
    $accuracy = $data[$index][3];
    $altitude = $data[$index][4];
    $velocity = $data[$index][5];
    $verticalAccuracy = $data[$index][6];
    $heading = $data[$index][7];
    $activity = $data[$index][8];
    $act_timestampMS = $data[$index][9];
    $act_confidence = $data[$index][10];
    $sql = $sql."('$username','$timestampMs','$latitudeE7','$longitudeE7','$accuracy','$altitude','$velocity','$verticalAccuracy','$heading','$activity','$act_timestampMS','$act_confidence'),";
  }
$sql = substr($sql, 0, -1);
$sql = $sql.";";
if (mysqli_query($conn, $sql)) {
 echo "Markers saved successfully\n";
} else {
 echo "Error: " . mysqli_error($conn);
}

  //GET SCORES AND DATES FROM DB
  $query ="SELECT activity FROM user_data WHERE username = '$username' ";
  $query= mysqli_query($conn, $query);
  $activity = Array();
  while($result = $query->fetch_assoc()){
    $activity[] = $result['activity']; //activity from DB
  }
  $query ="SELECT timestampMs FROM user_data WHERE username = '$username' ";
  $query= mysqli_query($conn, $query);
  $timestampMs = Array();
  while($result = $query->fetch_assoc()){
    $timestampMs[] = $result['timestampMs']; // timestampMs from DB
  }
   $countf= 0;
   $countv= 0;
   $sql = "REPLACE INTO user_score (username,score,score_date) values";
   //$timestampMs = $data[0][0];
   $seconds = $timestampMs[0]/ 1000;
   $tmp= date("Y-m-01", $seconds);
   for( $i = 0 ; $i < sizeof($timestampMs); $i++ ){
    //$activity = $data[$i][3];
    //$timestampMs = $data[$i][0];
     $seconds = $timestampMs[$i]/ 1000;
     $dt= date("Y-m-01", $seconds);
     if ($tmp != $dt){
       $countf = 0;
       $countv = 0; }
     if ($activity[$i] == 'ON_FOOT' || $activity[$i] == 'WALKING' || $activity[$i] == 'ON_BICYCLE' || $activity[$i] == 'RUNNING' ) {
        $countf = $countf + 1; }
      if ($activity[$i] == 'IN_VEHICLE' || $activity[$i] == 'IN_RAIL_VEHICLE' || $activity[$i] == 'IN_ROAD_VEHICLE' ) {
        $countv = $countv+ 1; }
         $tmp =$dt;
    if ($countf==0 && $countv==0) {
    $score = 0 ;   }
    else {
    $score=($countf/($countf+ $countv))*100; }
    $sql = $sql."('$username','$score','$dt'),";
   }
     $sql = substr($sql, 0, -1);
     $sql = $sql.";";
     if (mysqli_query($conn, $sql)) {
      echo "Score updated successfully\n";
     } else {
      echo "Error: " . mysqli_error($conn);
     }
     //GET USERS LAST UPLOAD DATE
     $timezone= new DateTime("now", new DateTimeZone('Europe/Bucharest') ); //timezone
     $upload_date = $timezone->format('Y-m-d'); // last upload
     $sql = "REPLACE INTO upload (username,upload_date) values";
     $sql = $sql."('$username','$upload_date '),";
     $sql = substr($sql, 0, -1);
     $sql = $sql.";";
     if (mysqli_query($conn, $sql)) {
       echo "Upload date: $upload_date\n";
     } else {
      echo "Error: " . mysqli_error($conn);
     }

// ============================

?>
