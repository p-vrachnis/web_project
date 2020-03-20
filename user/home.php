<?php
  include "./session.php";
  include "./header.php";
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
                <a>Score οικολογικης κίνησης</a>
              </div>
              <div id="date-range">
                <a>Περίοδος εγγραφών χρήστη</a>
              </div>
              <div id="last-upload">
                <a>Ημερομηνία τελευταίου upload</a>
              </div>
              <div id="leaderboard">
                <a >Leaderboard 3 users</a>
              </div>
            </div>
        </div>
        <div class="user_analyse">
          <div class="container">
            <p style="text-align: center">Ανάλυση στοιχείων χρήστη</p>
            <div id="box">
            <label class="label" for="from_year">Choose year:</label>
              <select name="slct" class="slct" id="from_year">
                <option selected disabled>from</option>
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
              <select name="slct" class="slct" id="until_year">
                <option selected disabled>until.</option>
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
              <label class="label" for="from_month" id="month_label">Choose month:</label>
               <select name="slct" class="slct" id="from_month">
                <option selected disabled>from</option>
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
              <select name="slct" class="slct" id="until_month">
                <option selected disabled>until.</option>
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
            </div>
            <button type="button" class="btn btn-success" id="show_btn">SHOW</button>
            <canvas id="activity_chart"></canvas>
            <table id="activity_hour_day" class="table table-sm table-hover table-dark">
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
