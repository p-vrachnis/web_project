<?php

//$username = $_SESSION['login_user'];
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
 $regyears=array_fill(0, 11, 0); //2010 to 2020
 if ($totalcount!=0){
  for( $i = 0 ; $i < sizeof($timestampMs); $i++ ) {
    $seconds = $timestampMs[$i] / 1000;
    //$tmp= date("Y-m-d", $seconds);
    $hour = date("H",$seconds) + 4; // swsta!!! // se 06 h wra
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
    for( $j = 0 ; $j <= 10; $j++ ){
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
$max_y=0;
$min_m=0;
$max_m=0;
$min_d=0;
$max_d=0;
$min_h=0;
$max_h=0;

/* Select specific range of dates and show the analysis of user data.  */
//$query ="SELECT latitudeE7, longitudeE7, timestampMs, activity, username FROM user_data ";
$query ="SELECT * FROM user_data ";
$query= mysqli_query($conn, $query);

$emptyshow=0;

if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['show'])) || (isset($_POST['export'])) ){
  if(empty($_POST['f_year']) || empty($_POST['u_year'])){
    $min_y=0;
    $max_y=2021;
    $emptyshow++;
  }
  else{
    $min_y = $_POST['f_year'];
    $max_y = $_POST['u_year']; }
 if(empty($_POST['f_month']) || empty($_POST['u_month'])){
  $min_m=0;
  $max_m=13;
  $emptyshow++;
 }
 else{
    $min_m = $_POST['f_month'];
    $max_m = $_POST['u_month']; }
  if(empty($_POST['f_day']) || empty($_POST['u_day'])){
    $min_d=0;
    $max_d=8;
    $emptyshow++;
  }
  else{
    $min_d = $_POST['f_day'];
    $max_d = $_POST['u_day']; }
  if(empty($_POST['f_hour']) || empty($_POST['u_hour'])){
    $min_h=0;
    $max_h=24;
    $emptyshow++;
   }
  else{
    $min_h = $_POST['f_hour'];
    $max_h = $_POST['u_hour']; }

  // Check if user input dates are valid.
  if ( $min_y > $max_y || $min_m >$max_m|| $min_d > $max_d || $min_h >$max_h ){
    echo "<script type='text/javascript'>alert('Wrong range of dates! Choose again.');</script>";
    $min_y=0;
    $max_y=2021;
    $min_m=0;
    $max_m=13;
    $min_d=0;
    $max_d=8;
    $min_h=0;
    $max_h=24;
  }else{
    // Find Timestamp
    $min_ts = strtotime(" $min_y-$min_m $min_h ");
    $max_ts = strtotime(" $max_y-$max_m $max_h ");
  }

  $activities = array();
  $acount=0;
  if (isset($_POST["activity"])){
  array_push ($activities, "ON_FOOT", "WALKING", "RUNNING", "ON_BICYCLE", "IN_VEHICLE",
  "IN_RAIL_VEHICLE", "IN_ROAD_VEHICLE", "STILL", "TILTING", "UNKNOWN" );
  $acount=10; }
  else {
  if(isset($_POST["activity1"])){
  array_push ($activities, 'ON_FOOT');
  $acount++; }
   if (isset($_POST['activity2'])){
  array_push ($activities, 'WALKING');
  $acount++;
  }
  if (isset($_POST['activity3'])){
  array_push ($activities, 'RUNNING');
  $acount++;
  }
  if (isset($_POST['activity4'])){
  array_push ($activities, 'ON_BICYCLE');
  $acount++;
  }
   if (isset($_POST['activity5'])){
  array_push ($activities, 'IN_VEHICLE');
  $acount++;
  }
   if (isset($_POST['activity6'])){
  array_push ($activities, 'IN_RAIL_VEHICLE');
  $acount++;
  }
   if (isset($_POST['activity7'])){
  array_push ($activities, 'IN_ROAD_VEHICLE');
  $acount++;
  }
  if (isset($_POST['activity8'])){
  array_push ($activities, 'STILL');
  $acount++;
  }
   if (isset($_POST['activity9'])){
  array_push ($activities, 'TILTING');
  $acount++;
  }
  if (isset($_POST['activity10'])){
  array_push ($activities, 'UNKNOWN');
  $acount++;
  }
 }
}

if ($emptyshow==4 && $acount==0 ) {
  $min_y=0;
  $max_y=0;
  $min_m=0;
  $max_m=0;
  $min_d=0;
  $max_d=0;
  $min_h=0;
  $max_h=0;
}

$i=0;
$c1=0;
while($result = $query->fetch_assoc()){
  $timestamps[] = $result['timestampMs']; // activity from DB
  $seconds = $timestamps[$i] / 1000;
  $hour2 = date("H",$seconds) + 3; // swsta!!! // se 06 h wra
  $day2  = date('N',$seconds); // se noumero h mera ths evdomadas (1-7)
  $year2 = date("Y", $seconds); // year
  $month2 = date("m", $seconds);
  $month2 = (int)$month2;
  $hour2 =(int)$hour2;
  $i++;
  if ($year2 >= $min_y &&  $year2 <= $max_y &&
  $month2 >= $min_m &&  $month2 <= $max_m &&
  $day2 >= $min_d &&  $day2 <= $max_d &&
  $hour2>= $min_h &&  $hour2 <= $max_h ) {
    if ($acount==10 || $acount==0 ){
    // for( $j = 0 ; $j < $acount; $j++ ){
    // if ($result['activity'] == $activities[$j]){
    $c1++;
    $lng[] = $result['longitudeE7'];
    $lat[] = $result['latitudeE7'];
    $act[] =  $result['activity'];
    $acc[] = $result['accuracy'];
    $alt[] = $result['altitude'];
    $vel[] = $result['velocity'];
    $a_time[] = $result['act_timestampMs'];
    $a_conf[] = $result['act_confidence'];
    $head[] = $result['heading'];
    $vert_acc[]= $result['verticalAccuracy'];
    $timest[]=  $result['timestampMs'];
    $us[]= $result['username'];  }
    else {
      for( $j = 0 ; $j < $acount; $j++ ){
        if ($result['activity'] == $activities[$j]){
          $c1++;
          $lng[] = $result['longitudeE7'];
          $lat[] = $result['latitudeE7'];
          $act[] =  $result['activity'];
          $acc[] = $result['accuracy'];
          $alt[] = $result['altitude'];
          $vel[] = $result['velocity'];
          $a_time[] = $result['act_timestampMs'];
          $a_conf[] = $result['act_confidence'];
          $head[] = $result['heading'];
          $vert_acc[] = $result['verticalAccuracy'];
          $timest[] =  $result['timestampMs'];
          $us[]= $result['username'];
        }
      }
    }
  }
}

if ($c1 != 0 ){
for( $i = 0 ; $i < $c1; $i++ ){
 $query ="SELECT userID,username FROM users WHERE username = '$us[$i]' ";
 $query= mysqli_query($conn, $query);
 while($result = $query->fetch_assoc()){
 $usid[$i] =  $result['userID']; } } }


function decimal($num){
  $snum = strval($num);
  $snum =  "" . substr($snum, 0, 2) . "." . substr($snum,2). "";
  return $snum;
}

// Not Show heatmap when export
$show=1;
if ((isset($_POST['export'])))
{  $show==0;}


if ($c1 != 0 && $show==1 ){
  $lat[0] = decimal($lat[0]);
  $lng[0] = decimal($lng[0]);

  //$temp_heatmap = array();
  $data_heatmap = array(array("lat"=>$lat[0], "lng"=>$lng[0]));

  // For each value of coordinates, we create an array (dictionary) to include lat,lon for the HeatMap
  for($iter=1; $iter<sizeof($lat); $iter++){
    $lat[$iter] = decimal($lat[$iter]);
    $lng[$iter] = decimal($lng[$iter]);

    $temp_heatmap = array("lat"=>$lat[$iter], "lng"=>$lng[$iter]);
    array_push($data_heatmap, $temp_heatmap);
  }

  // Array convert into JSON, in order to send them to Javascript file.
  $data_heatmap = json_encode($data_heatmap); }

// Check if delete button is checked.
if (isset($_POST['delete'])){
    // Delete all records from the table
    $sql = "DELETE  FROM user_data";
    $sql= mysqli_query($conn, $sql);
    $sql = "DELETE  FROM upload";
    $sql= mysqli_query($conn, $sql);
    $sql = "DELETE  FROM user_score";
    $sql= mysqli_query($conn, $sql);
    $sql = "DELETE  FROM users WHERE username <> 'admin';
    $sql= mysqli_query($conn, $sql);
  }

// EXPORTS
 if (isset($_POST['csv']) && isset($_POST['export'])){
 if ($c1!=0 ) {
  //$filename = "export";
  $file = fopen('export.csv',"w");
  $fields = array('longitude ', 'latitude ', 'activity ', 'accuracy ', 'altitude ', 'velocity ', 'activity_timestampMs ', 'activity_confidence ',
                  'heading ', 'verticalAccuracy ', 'timestampMs ', 'userID ');
  fputcsv($file, $fields);
  for ($i=0; $i <$c1; $i++){
  $data = array($lng[$i],$lat[$i],$act[$i],$acc[$i],$alt[$i],$vel[$i],$a_time[$i],$a_conf[$i],$head[$i],$vert_acc[$i],$timest[$i],$usid[$i]);
//foreach ($data as $line) {
    fputcsv($file, $data); }
  //}
  fclose($file);
     // header("Content-Type: text/csv");
     // header("Content-Disposition: attachment; filename=export.csv;");
     // readfile("export.csv");
    // $export=0;
    $filename=basename("../admin/export.csv");
    $_SESSION["filename"] = $filename;
    header("Location: ../admin/download.php");
  }
 }

 if (isset($_POST['json']) && isset($_POST['export'])){
  if ($c1!=0) {
    $json_data=array(); //create the array

    for($i=0; $i<$c1; $i++){
      $json_data[] = array('longitude'=> $lng[$i], 'latitude'=> $lat[$i], 'activity'=> $act[$i],
                            'accuracy'=> $acc[$i], 'altitude'=> $alt[$i], 'velocity'=> $vel[$i],
                            'activity_timestampMs'=> $a_time[$i], 'activity_confidence'=> $a_conf[$i],
                            'heading'=> $head[$i], 'verticalAccuracy'=> $vert_acc[$i],
                            'timestampMs'=> $timest[$i], 'userID'=> $usid[$i]);
    }
    $fp = fopen("export.json", 'w');
    $data = json_encode($json_data);
    fwrite($fp, $data);
    fclose($fp);
    $filename=basename("../admin/export.json");
    $_SESSION["filename"] = $filename;
    header("Location: ../admin/download.php");
  }
}

/* EXPORT XML */
if (isset($_POST['xml']) && isset($_POST['export'])){
  if ($c1!=0) {
    $dom = new DOMDocument();

		$dom->encoding = 'utf-8';

		$dom->xmlVersion = '1.0';

    $dom->formatOutput = true;

    $xml_file_name = 'export.xml';

      $root = $dom->createElement('AllData');
      $data_node = $dom->createElement('data');

    for($i=0; $i<$c1; $i++){
      $dlng = new DOMAttr('location', "'$i'");
      $data_node->setAttributeNode($dlng);

    $child_node_longitude = $dom->createElement('longitude', $lng[$i]);
      $data_node->appendChild($child_node_longitude);

    $child_node_latitude = $dom->createElement('latitude', $lat[$i]);
      $data_node->appendChild($child_node_latitude);

    $child_node_activity = $dom->createElement('activity', $act[$i]);
      $data_node->appendChild($child_node_activity);

    $child_node_accuracy = $dom->createElement('accuracy', $acc[$i]);
      $data_node->appendChild($child_node_accuracy);

    $child_node_altitude = $dom->createElement('altitude', $alt[$i]);
      $data_node->appendChild($child_node_altitude);

    $child_node_velocity = $dom->createElement('velocity', $vel[$i]);
      $data_node->appendChild($child_node_velocity);

    $child_node_act_timestampMs = $dom->createElement('act_timestampMs', $a_time[$i]);
      $data_node->appendChild($child_node_act_timestampMs);

    $child_node_act_confidence = $dom->createElement('act_confidence', $a_conf[$i]);
      $data_node->appendChild($child_node_act_confidence);

    $child_node_heading = $dom->createElement('heading', $head[$i]);
      $data_node->appendChild($child_node_heading);

    $child_node_act_verticalAccuracy = $dom->createElement('averticalAccuracy', $vert_acc[$i]);
      $data_node->appendChild($child_node_act_verticalAccuracy);

    $child_node_act_timestampMs = $dom->createElement('timestampMs', $timest[$i]);
      $data_node->appendChild($child_node_act_timestampMs);

    $child_node_act_username = $dom->createElement('userID', $usid[$i]);
      $data_node->appendChild($child_node_act_username);
    }
      $root->appendChild($data_node);
      $dom->appendChild($root);

    $dom->save($xml_file_name);

    $filename=basename("../admin/export.xml");
    $_SESSION["filename"] = $filename;
    header("Location: ../admin/download.php");
  }
}

?>
