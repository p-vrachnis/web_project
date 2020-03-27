<?php

$username = $_SESSION['login_user'];
include_once '../external/connect_db.php';

$timezone= new DateTime("now", new DateTimeZone('Europe/Bucharest') );
$current_date= $timezone->format('Y-m-01'); // current date
$week_days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
$hours_1 =  Array(
'12:00 am',
'1:00 am',
'2:00 am',
'3:00 am',
'4:00 am',
'5:00 am',
'6:00 am',
'7:00 am',
'8:00 am',
'9:00 am',
'10:00 am',
'11:00 am',
'12:00 pm',
'1:00 pm',
'2:00 pm',
'3:00 pm',
'4:00 pm',
'5:00 pm',
'6:00 pm',
'7:00 pm',
'8:00 pm',
'9:00 pm',
'10:00 pm',
'11:00 pm'
) ;

    //USERS
    $query ="SELECT username FROM users ";
    $query= mysqli_query($conn, $query);
    $user = Array();
    while($result = $query->fetch_assoc()){
      $user[] = $result['username']; //activity from DB
    }

   //Registers count for user
   $regcount = Array();
  for( $i = 0 ; $i < sizeof($user); $i++ ){
   $regcount[$i] = 0;
   $query ="SELECT timestampMs FROM user_data WHERE username = '$user[$i]'";
   $query= mysqli_query($conn, $query);
   while($result = $query->fetch_assoc()){
     //$timestampMs[] = $result['timestampMs']; // activity from DB
     $regcount[$i]++; //833 swsto
   }
  }

  //total registers
  $totalcount=0;
  $query ="SELECT timestampMs FROM user_data ";
  $query= mysqli_query($conn, $query);
  while($result = $query->fetch_assoc()){
    $timestampMs[] = $result['timestampMs']; // activity from DB
    $totalcount++;
  }

 // Registers per hour month day and year
 $reghours=array_fill(0, 24, 0);
 $regdays=array_fill(0, 7, 0);
 $regmonths=array_fill(0, 12, 0);
 $regyears=array_fill(0, 10, 0); //2010 to 2020
 if ($totalcount!=0){
  for( $i = 0 ; $i < sizeof($timestampMs); $i++ ) {
    $seconds = $timestampMs[$i] / 1000;
    //$tmp= date("Y-m-d", $seconds);
    $hour = date("H",$seconds) + 3; // swsta!!! // se 06 h wra
    $day  = date('N',$seconds); // se noumero h mera ths evdomadas
    $year = date("Y", $seconds); // year
    $month = date("m", $seconds);
    //$year= (int)$year;
    $tyear = $year - 2000;
    //$hour = (int)$hour;
    //$day = (int)$day;
    $month = (int)$month;

    for( $j = 0 ; $j <= 23; $j++ ){
      if ($hour==$j+1){ $reghours[$j]++;} }
    for( $j = 0 ; $j <= 6; $j++ ){
      if ($day==$j+1){ $regdays[$j]++;} }
    for( $j = 0 ; $j <= 11; $j++ ){
      if ($month==$j+1){ $regmonths[$j]++;} }
    for( $j = 0 ; $j <= 9; $j++ ){
      if ($tyear==($j+10)){ $regyears[$j]++;} }
    }

    for( $j = 1 ; $j <= 24; $j++ ){
      $reghours[$j-1] = (($reghours[$j-1])/sizeof($timestampMs))*100;}
    for( $j = 1 ; $j <= 7; $j++ ){
      $regdays[$j-1] = (($regdays[$j-1])/sizeof($timestampMs))*100;}
    for( $j = 1 ; $j <= 12; $j++ ){
      $regmonths[$j-1] = (($regmonths[$j-1])/sizeof($timestampMs))*100;}
    for( $j = 1 ; $j <= 10; $j++ ){
      $regyears[$j-1] = (($regyears[$j-1])/sizeof($timestampMs))*100;}

    //Register pr activities
    $query ="SELECT activity FROM user_data ";
    $query= mysqli_query($conn, $query);
    $activity = Array();
    while($result = $query->fetch_assoc()){
      $activity[] = $result['activity']; //activity from DB
    }
    // eggrafes ana eidos pososta
    $i=0;
    $on_foot=0;
    $walking=0;
    $on_bicycle=0;
    $running=0;
    $in_vehicle=0;
    $in_rail_vehicle=0;
    $still=0;
    $tilting=0;
    $unknown=0;
    $in_road_vehicle=0;
  // $hour = array_fill(0,10,0);
    $hour =array_fill(0, 25, array_fill(0, 11, 0));
    $day =array_fill(0, 8, array_fill(0, 11, 0));
    $maxh=array();

    for( $i = 0 ; $i < sizeof($activity); $i++ ) {
      $seconds = $timestampMs[$i]/ 1000;
      $hours = date("H",$seconds);// 06
      $days= date('N', $seconds);// days of week in  number
      $hours = (int)$hours; // 06 -> 6
    if ($activity[$i]=='ON_FOOT'){
      $on_foot++;
      $hour[$hours][1]++;
      $day[$days][1]++;
    }
    elseif ($activity[$i] == 'WALKING') {
      $walking++;
      $hour[$hours][2]++;
      $day[$days][2]++;
    }
    elseif ($activity[$i] == 'ON_BICYCLE') {
      $on_bicycle++;
      $hour[$hours][3]++;
      $day[$days][3]++;
    }
    elseif ($activity[$i] == 'RUNNING') {
      $running++;
      $hour[$hours][4]++;
      $day[$days][4]++;
    }
    elseif ($activity[$i] == 'IN_VEHICLE'){
      $in_vehicle++;
      $hour[$hours][5]++;
      $day[$days][5]++;
    }
    elseif ($activity[$i] == 'IN_RAIL_VEHICLE') {
      $in_rail_vehicle++;
      $hour[$hours][6]++;
      $day[$days][6]++;
    }
    elseif ($activity[$i] == 'STILL') {
      $still++;
      $hour[$hours][7]++;
      $day[$days][7]++;
    }
    elseif ($activity[$i] == 'TILTING') {
      $tilting++;
      $hour[$hours][8]++;
      $day[$days][8]++;
    }
    elseif ($activity[$i] == 'UNKNOWN' || $activity[$i] == '' ) {
      $unknown++;
      $hour[$hours][9]++;
      $day[$days][9]++;
    }
    elseif ($activity[$i] == 'IN_ROAD_VEHICLE'){
      $in_road_vehicle++;
      $hour[$hours][10]++;
      $day[$days][10]++;
    }
    }
    if ($i!=0){
      $on_foot=($on_foot/$i)*100 ;
      $walking=($walking/$i)*100;
      $on_bicycle=($on_bicycle/$i)*100;
      $running=($running/$i)*100;
      $in_vehicle=($in_vehicle/$i)*100;
      $in_rail_vehicle=($in_rail_vehicle/$i)*100;
      $still=($still/$i)*100 ;
      $tilting=($tilting/$i)*100 ;
      $unknown=($unknown/$i)*100 ;
      $in_road_vehicle=($in_road_vehicle/$i)*100;
  }
}

/* QUERYS FOR SELECT */

$min_y=0;
$max_y=2021;
$min_m=0;
$max_m=13;
$min_d=0;
$max_d=8;
$min_h=0;
$max_h=25;

/* Select specific range of dates and show the analysis of user data.  */
$months = array(
  "January" => 1,
  "February" => 2,
  "March" => 3,
  "April" => 4,
  "May" => 5,
  "June" => 6,
  "July" => 7,
  "August" => 8,
  "September" => 9,
  "October" => 10,
  "November" => 11,
  "December" => 12
);

$query ="SELECT latitudeE7, longitudeE7, timestampMs FROM user_data ";
$query= mysqli_query($conn, $query);

$i=0;

if($_SERVER['REQUEST_METHOD'] == "POST") {
  if(empty($_POST['f_year']) || empty($_POST['u_year'])){}
  else{
    $min_y = $_POST['f_year'];
    $max_y = $_POST['u_year']; }
 if(empty($_POST['f_month']) || empty($_POST['u_month'])){}
 else{
    $min_m = $_POST['f_month'];
    $max_m = $_POST['u_month']; }
  if(empty($_POST['f_day']) || empty($_POST['u_day'])){}
  else{
    $min_d = $_POST['f_day'];
    $max_d = $_POST['u_day']; }
  if(empty($_POST['f_hour']) || empty($_POST['u_hour'])){ }
  else{
    $min_h = $_POST['f_hour'];
    $max_h = $_POST['u_hour']; }

  // Check if user input dates are valid.
  if ( $min_y > $max_y || $min_m >$max_m ){
    echo "<script type='text/javascript'>alert('Wrong range of dates! Choose again.');</script>";
    $min_y=0;
    $max_y=2021;
    $min_m=0;
    $max_m=13;
    $min_d=0;
    $max_d=8;
    $min_h=0;
    $max_h=25;
  }else{
    // Find Timestamp
    $min_ts = strtotime(" $min_y-$min_m $min_h ");
    $max_ts = strtotime(" $max_y-$max_m $max_h ");
  }

}
// Check if delete button is checked.
if (isset($_POST['DELETE'])){
    // Delete all records from the table
    $sql = "DELETE  FROM user_data";
    $sql= mysqli_query($conn, $sql);
    $sql = "DELETE  FROM upload";
    $sql= mysqli_query($conn, $sql);
    $sql = "DELETE  FROM user_score";
    $sql= mysqli_query($conn, $sql);
  //  $sql = "DELETE  FROM users WHERE username <> 'admin';
  //  $sql= mysqli_query($conn, $sql);
  }

?>
