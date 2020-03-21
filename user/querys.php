<?php

$username = $_SESSION['login_user'];
//$data = json_decode($_POST['data']);
// SQL Insert Query of the data.
include_once '../external/connect_db.php';

// LAST UPLOAD DATE
$timezone= new DateTime("now", new DateTimeZone('Europe/Bucharest') );
$upload_date = 0;
$query = "SELECT upload_date FROM upload WHERE username = '$username' ";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_row($result);
$upload_date = $result[0];

// GET FIRST AND LAST REGISTER
$min = 0;
$max = 0;
$query = "SELECT MIN(score_date) AS min , MAX(score_date) AS max FROM user_score WHERE username = '$username' ";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_row($result);
$min = $result[0]; // first eggrafh date
$max = $result[1]; // last eggrafh date

//GET MONTHLY SCORE
$current_date= $timezone->format('Y-m-00'); // current date
$month_score = 0;
$query = "SELECT score AS month_score FROM user_score WHERE score_date = '$current_date' and username = '$username'   ";
$result = mysqli_query($conn,$query);
$count = mysqli_num_rows($result);
  if($count == 1) {
    $result = mysqli_fetch_row($result);
    $month_score = $result[0]; } // monthly score
 else {
    //echo "No monthly score has been registered\n ";
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
     //echo "Last 12 months score exists\n" ;
     $months_score[] = $result['months_score'];
     $months_date[]  = $result['months_date']; } } // last 12 months score
  else  {
      //echo "No 12 months score has been registered\n";
    }

      // TOP 3 Leaderboard
      $query = "SELECT score AS mscore, username AS user FROM user_score WHERE score_date = '$current_date' ORDER by mscore DESC  ";
      $query= mysqli_query($conn, $query);
      $mscore = Array();
      $user = Array();
      $count=0;
      //echo "TOP 3 leaderboard\n" ;
       while($result = $query->fetch_assoc()){
         $mscore[] = $result['mscore'];
         $user[] = $result['user'];
         $count++;
       }
     if ($count != 0 ){
     $i=0;
     for($i=0; $i < $count; $i++){
     //echo "$mscore[$i]  $user[$i]\n " ;   // TOP 3
     //$i++ ;
   } }
     else {
       //echo " - ";
     }




?>
