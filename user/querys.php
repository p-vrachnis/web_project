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
$min = $result[0]; // first register date
$max = $result[1]; // last register date

//GET MONTHLY SCORE
$current_date= $timezone->format('Y-m-01'); // current date
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
  $tempdate = $time->modify('-1 year')->format('Y-m-01');
  $query = "SELECT score AS months_score,score_date AS months_date  FROM user_score WHERE score_date >= '$tempdate' and username = '$username'   ";
  $query= mysqli_query($conn, $query);
  $months_score = Array();
  $months_date = Array();
  //if ($result = $query->fetch_assoc()) {
   while($result = $query->fetch_assoc()){
     //echo "Last 12 months score exists\n" ;
     $months_score[] = $result['months_score'];
     $months_date[]  = $result['months_date']; } //} // last 12 months score

  //else  {
      //echo "No 12 months score has been registered\n";
    //}

    // Fill the missing scores of each month
    $size_month_score = sizeof($months_score);
    while( $size_month_score < 12){
      array_push($months_score, 0);
      $size_month_score++;
    }

    // Create array of the last 12 months
    $year_months = array(
      strval(date("F", strtotime("0 months"))) => 0,
      strval(date("F", strtotime("-1 months"))) => 0,
      strval(date("F", strtotime("-2 months"))) => 0,
      strval(date("F", strtotime("-3 months"))) => 0,
      strval(date("F", strtotime("-4 months"))) => 0,
      strval(date("F", strtotime("-5 months"))) => 0,
      strval(date("F", strtotime("-6 months"))) => 0,
      strval(date("F", strtotime("-7 months"))) => 0,
      strval(date("F", strtotime("-8 months"))) => 0,
      strval(date("F", strtotime("-9 months"))) => 0,
      strval(date("F", strtotime("-10 months"))) => 0,
      strval(date("F", strtotime("-11 months"))) => 0
    );

    // Check if value key of year_months (array) is equal with the value of the array months_date,
    // if yes, then change the specific value of the years_month.
    for($count = 0; $count < sizeof($months_date); $count++){
      $check_key = strval(date("F", strtotime($months_date[$count])));
      if (array_key_exists($check_key,$year_months)){
        $year_months[$check_key] = $months_score[$count];
      }
    }

      // TOP 3 Leaderboard
      $query = "SELECT score AS mscore, username AS user FROM user_score WHERE score_date = '$current_date' ORDER by mscore DESC  ";
      $query= mysqli_query($conn, $query);
      $mscore = Array();
      $user = Array();
      $count=0;
      $check=0;
      //echo "TOP 3 leaderboard\n" ;
       while($result = $query->fetch_assoc()){
         $mscore[] = $result['mscore'];
         $user[] = $result['user'];
         if ($user[$count]== $username){
           $user_score=$mscore[$count];
           $check=1;
         }
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

     // timestampMs
     $query ="SELECT timestampMs FROM user_data WHERE username = '$username' ";
     $query= mysqli_query($conn, $query);
     $timestampMs = Array();
     while($result = $query->fetch_assoc()){
       $timestampMs[] = $result['timestampMs']; // timestampMs from DB
     }
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


    if($_SERVER['REQUEST_METHOD'] == "POST") {
      if(empty($_POST['f_month']) || empty($_POST['f_year']) || empty($_POST['u_month']) || empty($_POST['u_year'])){
        $min_time=0;
        $max_time=0;
      }else{

        $f_month = $_POST['f_month'];
        $f_year = $_POST['f_year'];
        $u_month = $_POST['u_month'];
        $u_year = $_POST['u_year'];

        // Check if user input dates are valid.
        if ($f_year > $u_year || $months[$f_month] > $months[$u_month] ){
          echo "<script type='text/javascript'>alert('Wrong range of dates! Choose again.');</script>";
          $min_time=0;
          $max_time=0;
        }else{
          $from_ts = strtotime(" $f_month $f_year");
          $until_ts = strtotime(" $u_month $u_year");
          $min_time=$from_ts;
          $max_time=$until_ts;
        }
      }
    }
    else{
      $min_time=0;
      $max_time=0;
    }

    // Function which converts number to a string and inserting a decimal point in the third place of it.
    function decimal($num){
      $snum = strval($num);
      $snum =  "" . substr($snum, 0, 2) . "." . substr($snum,2). ""; 
      return $snum;
    }

    // Latitude query
    $query ="SELECT latitudeE7 FROM user_data WHERE timestampMs > '$min_time' and timestampMs < '$max_time' ";
    $query= mysqli_query($conn, $query);
    $lat = Array();
    while($result = $query->fetch_assoc()){
      $lat[] = $result['latitudeE7']; 
    }
    
    // Longtude query
    $query ="SELECT longitudeE7 FROM user_data WHERE timestampMs > '$min_time' and timestampMs < '$max_time' ";
    $query= mysqli_query($conn, $query);
    $lng = Array();
    while($result = $query->fetch_assoc()){
      $lng[] = $result['longitudeE7']; 
    }


    $lat[0] = decimal($lat[0]);
    $lng[0] = decimal($lng[0]);

    $temp_heatmap = array();
    $data_heatmap = array(array("lat"=>$lat[0], "lng"=>$lng[0]));

    // For each value of coordinates, we create an array (dictionary) to include lat,lon for the HeatMap
    for($iter=1; $iter<sizeof($lat); $iter++){
      $lat[$iter] = decimal($lat[$iter]);
      $lng[$iter] = decimal($lng[$iter]);

      $temp_heatmap = array("lat"=>$lat[$iter], "lng"=>$lng[$iter]);
      array_push($data_heatmap, $temp_heatmap);
    }

    // Array convert into JSON, in order to send them to Javascript file.
    $data_heatmap = json_encode($data_heatmap);

     //activities
     $query ="SELECT activity FROM user_data WHERE username = '$username' and  timestampMs > '$min_time' and timestampMs < '$max_time' ";
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
     $week_days = array(' - ','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
     for( $i = 0 ; $i < sizeof($activity); $i++ ) {
       $seconds = $timestampMs[$i]/ 1000;
       $hours = date("H",$seconds); // ena apo ta duo einai swsto
      //  $hours = date("H",$timestampMs[$i]);
      //  $days= date('N', $timestampMs[$i]);
      $days = date('N', $seconds);
      $hours = (int)$hours;
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
     $running=($on_bicycle/$i)*100;
     $running=($running/$i)*100;
     $in_vehicle=($in_vehicle/$i)*100;
     $in_rail_vehicle=($in_rail_vehicle/$i)*100;
     $still=($still/$i)*100 ;
     $tilting=($tilting/$i)*100 ;
     $unknown=($unknown/$i)*100 ;
     $in_road_vehicle=($in_road_vehicle/$i)*100;
    }

    // MAX SCORE HOUR
    for( $i = 1 ; $i <=10; $i++ ){
      $maxh[$i]='-';
      if($hour[1][$i]!=0){ $maxh[$i]=1;}
      for ( $j = 1 ; $j <24; $j++ ){
       if($hour[$j][$i] < $hour[$j+1][$i] ){
        $maxh[$i]=$j+1;
       }
      }
    }
    //MAX SCORE DAY
    for( $i = 1 ; $i <=10; $i++ ){
      $maxd[$i]=' ';
      if($day[1][$i]!=0){$maxd[$i]=$week_days[1];}
      for ( $j = 1 ; $j <7; $j++ ){
       if($day[$j][$i] < $day[$j+1][$i] ){
        $maxd[$i]=$week_days[$j+1];
        //$maxd = date("D",$maxd);
       }
      }
    }

?>
