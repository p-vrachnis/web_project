<?php
  session_start();
  $username = $_SESSION['login_user'];
  $data = json_decode($_POST['data']);
  // SQL Insert Query of the data.
  include_once '../external/connect_db.php';
  $sql = "REPLACE INTO user_data (username, timestampMs, latitudeE7, longitudeE7, activity) values";
  $countf= 0;
  $countv= 0;
  $c = 1;
$timestampMs = $data[0][0];
$seconds = $timestampMs/ 1000;
$tmp= date("Y-m-00", $seconds);
  for( $index = 0; $index < sizeof($data) ; $index++ ){
    $timestampMs = $data[$index][0];
    $latitudeE7 = $data[$index][1];
    $longitudeE7 = $data[$index][2];
    $activity = $data[$index][3];
    $seconds = $timestampMs/ 1000;
    $dt= date("Y-m-00", $seconds);
    if ($tmp != $dt){
     $c = $c + 1; }
    $tmp =$dt;
    $sql = $sql."('$username','$timestampMs',$latitudeE7,$longitudeE7,'$activity'),";
}
   $sql = "REPLACE INTO user_score (username,score,score_date) values";
   $timestampMs = $data[0][0];
   $seconds = $timestampMs/ 1000;
   $tmp= date("Y-m-00", $seconds);
   for( $i = 0 ; $i < sizeof($data); $i++ ){
     $activity = $data[$i][3];
     $timestampMs = $data[$i][0];
     $seconds = $timestampMs/ 1000;
     $dt= date("Y-m-00", $seconds);
     if ($tmp != $dt){
       $countf = 0;
       $countv=0; }
     if ($activity == 'ON_FOOT') {
        $countf = $countf + 1; }
      if ($activity == 'IN_VEHICLE') {
        $countv = $countv+ 1; }
         $tmp =$dt;
    if ($countf==0 && $countv==0) {
    $score =0 ;   }
    else {
    $score=($countf/($countf+ $countv))*100;
    $sql = $sql."('$username','$score','$dt'),";  } }
  $date = date('Y-m-00');
  echo '<script type="text/javascript">alert("'.$date.'");</script>';
  $sql = substr($sql, 0, -1);
  $sql = $sql.";";
  if (mysqli_query($conn, $sql)) {
   echo "Markers saved successfully";
  } else {
   echo "Error: " . mysqli_error($conn);
  }
?>
