<?php

$username = $_SESSION['login_user'];
include_once '../external/connect_db.php';

$timezone= new DateTime("now", new DateTimeZone('Europe/Bucharest') );
$current_date= $timezone->format('Y-m-01'); // current date
$week_days = array(' - ','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
$hours_1 =  Array('-',
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

    //=================== ADMIN ==================

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
 for( $i = 0 ; $i < sizeof($timestampMs); $i++ ) {
  $seconds = $timestampMs[$i] / 1000;
  //$tmp= date("Y-m-d", $seconds);
  $hour = date("H",$seconds); // swsta!!! // se 06 h wra
  $day  = date('N',$seconds); // se noumero h mera ths evdomadas
  $year = date("Y", $seconds); // year
  $month = date("m", $seconds);
  //$year= (int)$year;
  $tyear = $year - 2000;
  //$hour = (int)$hour;
  //$day = (int)$day;
  $month = (int)$month;

  for( $j = 1 ; $j <= 24; $j++ ){
    if ($hour==$j){ $reghours[$j-1]++;} }
  for( $j = 1 ; $j <= 7; $j++ ){
    if ($day==$j){ $regdays[$j-1]++;} }
  for( $j = 1 ; $j <= 12; $j++ ){
    if ($month==$j){ $regmonths[$j-1]++;} }
  for( $j = 1 ; $j <= 10; $j++ ){
    if ($tyear==($j+10)){ $regyears[$j]++;} }
  }
  //$day = $week_days[$day]; // // h mera se onoma

  // for( $j = 1 ; $j <= 24; $j++ ){
  //   ($reghours[$j]/sizeof($timestampMs)*100;}
  // for( $j = 1 ; $j <= 7; $j++ ){
  //   ($regdays$j]/sizeof($timestampMs)*100}
  // for( $j = 1 ; $j <= 12; $j++ ){
  //   ($regmonths[$j]/sizeof($timestampMs)*100}
  // for( $j = 1 ; $j <= 10; $j++ ){
  //   ($regyears[$j]/sizeof($timestampMs)*100}




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
   elseif ($activity[$i] == 'UNKNOWN') {
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


?>
