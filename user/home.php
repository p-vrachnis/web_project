<?php
  include "./session.php";
  include "./header.php";
  include "./querys.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../external/jquery-3.4.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <link href="../external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Home Page</title>
</head>

<body>
    <div class="design">
      <div class="main_content">
        <div class="user_info">
            <div class="container">
              <div id="score">
                <a>Score οικολογικης κίνησης </a>
                <div id="eco-value">
                  <?php
                  if ( $month_score != 0 ){
                  echo "Montlhy score $month_score%"; }
                  else {
                    echo "Monthly score  -";
                  }
                  ?>
                </div>
              </div>
              <div id="date-range">
                <a>Περίοδος εγγραφών χρήστη</a>
                <div id="date-range-value">
                  <?php
                  if  ($max != 0){
                    echo "$min  \  $max"; }
                    else {
                      echo " - ";
                    }
                  ?>
                </div>
              </div>
              <div id="last-upload">
                <a>Ημερομηνία τελευταίου upload</a>
                <div id="last-upload-value">
                  <?php
                  if  ($upload_date != 0){
                  echo "$upload_date "; }
                  else {
                    echo " - ";
                  }
                  ?>
                </div>
              </div>
              <div id="leaderboard">
                <a >Leaderboard TOP 3 users </a>
                <div>
                  <table id="leaderboard-table" class="table table-sm table-hover table-light">
                    <thead id="header_lead">
                      <tr>
                        <th scope="col">RANK</th>
                        <th scope="col">NAME</th>
                        <th scope="col">ECO SCORE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="rank1">#1</td>
                        <th scope="row">
                        <?php
                        if ($count >=1 ){
                        echo "$user[0]  " ;  }
                        ?>
                        </th>
                        <td><?php
                        if ($count >=1 ){
                        echo "$mscore[0]%" ;  }
                        ?> </td>
                      </tr>
                      <tr>
                        <td id="rank2">#2</td>
                        <th scope="row"><?php
                        if ($count >=2 ){
                        echo "$user[1] " ;  }
                        ?>
                      </th>
                        <td><?php
                        if ($count >=2){
                        echo "$mscore[1]% " ;  }
                        ?>
                      </td>
                      </tr>
                      <tr>
                        <td id="rank3">#3</td>
                        <th scope="row"><?php
                        if ($count >=3 ){
                        echo "$user[2] " ;  }
                        ?>
                      </th>
                        <td><?php
                        if ($count >=3 ){
                        echo "$mscore[2]% " ;  }
                        ?>
                      </td>
                      </tr>
                      <tr>
                        <td id="myrank">#myrank</td>
                        <th scope="row"><?php echo $username ?></th>
                        <td><?php
                        if ($check ==1){
                          echo "$user_score%";
                         }?>
                       </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="user_analyse">
          <div class="container">
            <p style="text-align: center">Ανάλυση στοιχείων χρήστη</p>
            <div id="box">
            <label class="label" for="from-date-month">Choose date from:</label>
            <select name="slct" class="slct" id="from-date-month">
                <option selected disabled>month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select name="slct" class="slct" id="from-date-year">
                <option selected disabled>year</option>
                <option value="2010" >2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
              <label class="label" for="until-date-month">, until:</label>
              <select name="slct" class="slct" id="until-date-month">
                <option selected disabled>month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select name="slct" class="slct" id="until-date-year">
                <option selected disabled>year</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
            </div>
            <button type="button" class="btn btn-success" id="show_btn">SHOW</button>
            <canvas id="activity_chart"></canvas>
            <table id="activity_hour_day" class="table table-sm table-hover table-light">
              <thead id="header_ahd">
                <tr>
                  <th scope="col">ACTIVITY</th>
                  <th scope="col">HOUR</th>
                  <th scope="col">DAY</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">STILL</th>
                  <td>d21</td>
                  <td>d22</td>
                </tr>
                <tr>
                  <th scope="row">IN VEHICLE</th>
                  <td>d31</td>
                  <td>d32</td>
                </tr>
                <tr>
                  <th scope="row">ON FOOT</th>
                  <td>d41</td>
                  <td>d42</td>
                </tr>
                <tr>
                  <th scope="row">IN ROAD VEHICLE</th>
                  <td>d51</td>
                  <td>d52</td>
                </tr>
                <tr>
                  <th scope="row">IN RAIL VEHCILE</th>
                  <td>d61</td>
                  <td>d62</td>
                </tr>
                <tr>
                  <th scope="row">WALKING</th>
                  <td>d71</td>
                  <td>d72</td>
                </tr>
                <tr>
                  <th scope="row">ON BICYCLE</th>
                  <td>d81</td>
                  <td>d82</td>
                </tr>
                <tr>
                  <th scope="row">RUNNING</th>
                  <td>d91</td>
                  <td>d92</td>
                </tr>
                <tr>
                  <th scope="row">TILTITNG</th>
                  <td>d101</td>
                  <td>d102</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="data_load">
          <?php include "../map/leaflet.php" ?>
        </div>
      </div>
    </div>

  <script src="user_home_graph.js"></script>
</body>
</html>
