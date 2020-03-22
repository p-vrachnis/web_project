<?php

  session_start();
  $username = $_SESSION['login_user'];
  $data = json_decode($_POST['data']);
  // SQL Insert Query of the data.
  include_once '../external/connect_db.php';
  // GET ALL JSON DATA TO DATABASE
  $sql = "REPLACE INTO user_data (username, timestampMs, latitudeE7, longitudeE7, activity) values";
  for( $index = 0; $index < sizeof($data) ; $index++ ){
    $timestampMs = $data[$index][0];
    $latitudeE7 = $data[$index][1];
    $longitudeE7 = $data[$index][2];
    $activity = $data[$index][3];
    $sql = $sql."('$username','$timestampMs',$latitudeE7,$longitudeE7,'$activity'),";
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
   $tmp= date("Y-m-00", $seconds);
   for( $i = 0 ; $i < sizeof($timestampMs); $i++ ){
    //$activity = $data[$i][3];
    //$timestampMs = $data[$i][0];
     $seconds = $timestampMs[$i]/ 1000;
     $dt= date("Y-m-00", $seconds);
     if ($tmp != $dt){
       $countf = 0;
       $countv = 0; }
     if ($activity[$i] == 'ON_FOOT' || $activity[$i] == 'WALKING' || $activity[$i] == 'ON_BICYCLE' || $activity[$i] == 'RUNNING' ) {
        $countf = $countf + 1; }
      if ($activity[$i] == 'IN_VEHICLE' || $activity[$i] == 'IN_RAIL_VEHICLE') {
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

    /*
     // GET FIRST AND LAST REGISTER
     $query = "SELECT MIN(score_date) AS min , MAX(score_date) AS max FROM user_score WHERE username = '$username' ";
     $result = mysqli_query($conn, $query);
     $result = mysqli_fetch_row($result);
     $min = $result[0]; // first eggrafh date
     $max = $result[1]; // last eggrafh date

     //GET MONTHLY SCORE
     $current_date= $timezone->format('Y-m-00'); // current date
     $query = "SELECT score AS month_score FROM user_score WHERE score_date = '$current_date' and username = '$username'   ";
     $result = mysqli_query($conn,$query);
     $count = mysqli_num_rows($result);
       if($count == 1) {
         $result = mysqli_fetch_row($result);
         $month_score = $result[0]; } // monthly score
      else {
         echo "No monthly score has been registered\n ";
       }

         //GET LAST 12 MONTHS SCORE FOR EACH MONTH
         $time = new DateTime('now');
         $tempdate = $time->modify('-1 year')->format('Y-m-00');
         $query = "SELECT score AS months_score,score_date AS months_date  FROM user_score WHERE score_date >= '$tempdate' and username = '$username'   ";
         $query= mysqli_query($conn, $query);
         $months_score = Array();
         $months_date = Array();
         if ($result = $query->fetch_assoc()) {
          while($result = $query->fetch_assoc()){
            echo "Last 12 months score exists\n" ;
            $months_score[] = $result['months_score'];
            $months_date[]  = $result['months_date']; } } // last 12 months score
         else  {
             echo "No 12 months score has been registered\n";
           }

             // TOP 3 Leaderboard
             $query = "SELECT score AS mscore, username AS user FROM user_score WHERE score_date = '$current_date' ORDER by mscore DESC  ";
             $query= mysqli_query($conn, $query);
             $mscore = Array();
             $user = Array();
             $count=0;
             echo "TOP 3 leaderboard\n" ;
              while($result = $query->fetch_assoc()){
                $mscore[] = $result['mscore'];
                $user[] = $result['user'];
                $count++;
              }
            if ($count != 0 ){
            $i=0;
            for($i=0; $i < $count; $i++){
            echo "$mscore[$i]  $user[$i]\n " ;   // TOP 3
            //$i++ ;
          } }
            else {
              echo " - ";
            }
            */

?>
