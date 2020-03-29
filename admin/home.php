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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="../external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Home Page</title>
</head>

<body>
    <div class="design">
      <div class="main_content">
        <div class="user_info">
          <p> DASHBOARD </p>
          <div id="flex-container1">
            <div><canvas id="year_activity_chart"></canvas></div>
            <div><canvas id="month_activity_chart"></canvas></div>
          </div>
          <div id="flex-container2">
            <div><canvas id="week_activity_chart"></canvas></div>
            <div><canvas id="hour_activity_chart"></canvas></div>
          </div>
          <div id="flex-container3">
            <div><canvas id="user_activity_chart"></canvas></div>
          </div>
        </div>
        <div class="user_analyse">
          <p style="text-align: center">Απεικόνιση κατάστασης ΒΔ (dashboard)</p>
          <div id="flex-container0">
            <canvas id="admin_activity_chart"></canvas>
            <form id="admin-data-analysis"  method="POST" action= "">
              <div id="box">
                <p style="text-align: center">Επιλογές εμφάνισης/export</p>
                <div id="box-flex1">
                  <label class="label" for="from-date-month">Choose date from:</label>
                  <select name="f_month" class="slct" id="from-date-month" form="admin-data-analysis">
                    <option selected disabled>month</option>
                    <option value=1>January</option>
                    <option value=2>February</option>
                    <option value=3>March</option>
                    <option value=4>April</option>
                    <option value=5>May</option>
                    <option value=6>June</option>
                    <option value=7>July</option>
                    <option value=8>August</option>
                    <option value=9>September</option>
                    <option value=10>October</option>
                    <option value=11>November</option>
                    <option value=12>December</option>
                  </select>
                  <select name="f_year" class="slct" id="from-date-year" form="admin-data-analysis">
                    <option selected disabled>year</option>
                    <option value=2010 >2010</option>
                    <option value=2011>2011</option>
                    <option value=2012>2012</option>
                    <option value=2013>2013</option>
                    <option value=2014>2014</option>
                    <option value=2015>2015</option>
                    <option value=2016>2016</option>
                    <option value=2017>2017</option>
                    <option value=2018>2018</option>
                    <option value=2019>2019</option>
                    <option value=2020>2020</option>
                  </select>
                  <label class="label" for="until-date-month">until:</label>
                  <select name="u_month" class="slct" id="until-date-month" form="admin-data-analysis">
                    <option selected disabled>month</option>
                    <option value=1>January</option>
                    <option value=2>February</option>
                    <option value=3>March</option>
                    <option value=4>April</option>
                    <option value=5>May</option>
                    <option value=6>June</option>
                    <option value=7>July</option>
                    <option value=8>August</option>
                    <option value=9>September</option>
                    <option value=10>October</option>
                    <option value=11>November</option>
                    <option value=12>December</option>
                  </select>
                  <select name="u_year" class="slct" id="until-date-year" form="admin-data-analysis">
                    <option selected disabled>year</option>
                    <option value=2010>2010</option>
                    <option value=2011>2011</option>
                    <option value=2012>2012</option>
                    <option value=2013>2013</option>
                    <option value=2014>2014</option>
                    <option value=2015>2015</option>
                    <option value=2016>2016</option>
                    <option value=2017>2017</option>
                    <option value=2018>2018</option>
                    <option value=2019>2019</option>
                    <option value=2020>2020</option>
                  </select>
                </div>
                <div id="box-flex2">
                  <label class="label" for="from-day">Choose day from:</label>
                  <select name="f_day" class="slct" id="from-day" form="admin-data-analysis">
                    <option selected disabled>Day</option>
                    <option value=1>Monday</option>
                    <option value=2>Tuesday</option>
                    <option value=3>Wednesday</option>
                    <option value=4>Thursday</option>
                    <option value=5>Friday</option>
                    <option value=6>Saturday</option>
                    <option value=7>Sunday</option>
                  </select>
                  <label class="label" for="until-day">until:</label>
                  <select name="u_day" class="slct" id="until-day" form="admin-data-analysis">
                    <option selected disabled>Day</option>
                    <option value=1>Monday</option>
                    <option value=2>Tuesday</option>
                    <option value=3>Wednesday</option>
                    <option value=4>Thursday</option>
                    <option value=5>Friday</option>
                    <option value=6>Saturday</option>
                    <option value=7>Sunday</option>
                  </select>
                </div>
                <div id="box-flex3">
                  <label class="label" for="from-hour">Choose hour from:</label>
                  <select name="f_hour" class="slct" id="from-hour" form="admin-data-analysis">
                    <option selected disabled>Hour</option>
                    <option value=0>00:00</option>
                    <option value=1>01:00</option>
                    <option value=2>02:00</option>
                    <option value=3>03:00</option>
                    <option value=4>04:00</option>
                    <option value=5>05:00</option>
                    <option value=6>06:00</option>
                    <option value=7>07:00</option>
                    <option value=8>08:00</option>
                    <option value=9>09:00</option>
                    <option value=10>10:00</option>
                    <option value=11>11:00</option>
                    <option value=12>12:00</option>
                    <option value=13>13:00</option>
                    <option value=14>14:00</option>
                    <option value=15>15:00</option>
                    <option value=16>16:00</option>
                    <option value=17>17:00</option>
                    <option value=18>18:00</option>
                    <option value=19>19:00</option>
                    <option value=20>20:00</option>
                    <option value=21>21:00</option>
                    <option value=22>22:00</option>
                    <option value=23>23:00</option>
                  </select>
                  <label class="label" for="until-hour">until:</label>
                  <select name="u_hour" class="slct" id="until-hour" form="admin-data-analysis">
                    <option selected disabled>Hour</option>
                    <option value=0>00:00</option>
                    <option value=1>01:00</option>
                    <option value=2>02:00</option>
                    <option value=3>03:00</option>
                    <option value=4>04:00</option>
                    <option value=5>05:00</option>
                    <option value=6>06:00</option>
                    <option value=7>07:00</option>
                    <option value=8>08:00</option>
                    <option value=9>09:00</option>
                    <option value=10>10:00</option>
                    <option value=11>11:00</option>
                    <option value=12>12:00</option>
                    <option value=13>13:00</option>
                    <option value=14>14:00</option>
                    <option value=15>15:00</option>
                    <option value=16>16:00</option>
                    <option value=17>17:00</option>
                    <option value=18>18:00</option>
                    <option value=19>19:00</option>
                    <option value=20>20:00</option>
                    <option value=21>21:00</option>
                    <option value=22>22:00</option>
                    <option value=23>23:00</option>
                  </select>
                </div>
                <div id="box-flex4">
                  <label class="label">Choose one or more Activities: </label>
                  <div id="selectall-div">
                      <input type="radio" name="activity" id="selectall" value="selectall" /><label class="radio-label" id="radio-label-all" for="selectall">Select All</label>
                  </div>
                  <div>
                    <div >
                      <input type="radio" name="activity1" id="on_foot" value="on_foot" /><label class="radio-label" for="on_foot">On Foot</label>
                      <input type="radio" name="activity2" id="walking" value="walking"  /><label class="radio-label" for="walking">Walking</label>
                      <input type="radio" name="activity3" id="running" value="running" /><label class="radio-label" for="running">Running</label>
                      <input type="radio" name="activity4" id="on_bicycle" value="on_bicycle" /><label class="radio-label" for="on_bicycle">On Bicycle</label>
                      <input type="radio" name="activity5" id="in_vehicle" value="in_vehicle" /><label class="radio-label" for="in_vehicle">In Vehicle</label>
                    </div>
                    <div >
                      <input type="radio" name="activity6" id="in_rail_vehicle" value="in_rail_vehicle" /><label class="radio-label" for="in_rail_vehicle">In Rail Vehicle</label>
                      <input type="radio" name="activity7" id="in_road_vehicle" value="in_road_vehicle" /><label class="radio-label" for="in_road_vehicle">In Road Vehicle</label>
                      <input type="radio" name="activity8" id="still" value="still" /><label class="radio-label" for="still">Still</label>
                      <input type="radio" name="activity9" id="tilting" value="tilting" /><label class="radio-label" for="tilting">Tilting</label>
                      <input type="radio" name="activity10" id="unknown" value="unknown" /><label class="radio-label" for="unknown">Unknown</label>
                    </div>
                  </div>
                </div>
              </div>
              <div id="box-flex-btn">
                <button type="submit" class="btn btn-success" id="show_btn" name="show" value="submit">SHOW TO MAP</button>
                <div id="export_options" style="display: none">
                  <label class="checkbox-inline">Choose type:</label>
                  <input type="checkbox" value="json" class="export">JSON</input>
                  <input type="checkbox" value="xml" class="export">XML</input>
                  <input type="checkbox" value="csv" class="export">CSV</input>
                  <button class="btn btn-success" id="ok-export" type="submit" name="DELETE">OK</button>
                  <input type="button" value="CANCEL" id="cancel-export">
                </div>
              </div>
            </form>
            <button class="btn btn-info" id="export_btn">EXPORT DATA</button>
          </div>
        </div>
        <div class="data_load">
          <div id="heatmap">
            <?php include "../map/aheatmap.php" ?>
          </div>
          <div>
            <button class="btn btn-danger" id="delete">DELETE DATA FROM DATABASE</button>
            <form id="delete_form" action="querys.php" method="POST">
              <div id="del-conf" style="display: none">
                <p id="check-msg">Are you sure?</p>
                <button class="btn btn-success" id="delete-conf" type="submit" name="DELETE" value="submit">YES</button>
                <input type="button" value="NO" id="delete-neg">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  <script src="ahome.js"></script>

  <script>
    var still = <?php echo $still; ?>;
    var on_foot = <?php echo $on_foot; ?>;
    var walking = <?php echo $walking; ?>;
    var on_bicycle = <?php echo $on_bicycle; ?>;
    var running = <?php echo $running; ?>;
    var in_vehicle = <?php echo $in_vehicle; ?>;
    var in_rail_vehicle = <?php echo $in_rail_vehicle; ?>;
    var tilting = <?php echo $tilting; ?>;
    var unknown = <?php echo $unknown; ?>;
    var in_road_vehicle = <?php echo $in_road_vehicle; ?>;
  </script>
  <script src="admin_activity_chart.js"></script>

  <script>
    var reghours = <?php echo json_encode($reghours); ?>;
  </script>
  <script src="admin_hour_activity_chart.js"></script>

  <script>
    var regmonths = <?php echo json_encode($regmonths); ?>;
  </script>
  <script src="admin_month_activity_chart.js"></script>

  <script>
    var regdays = <?php echo json_encode($regdays); ?>;
  </script>
  <script src="admin_week_activity_chart.js"></script>

  <script>
    var user = <?php echo json_encode($user); ?>;
    user.splice(0,1);
    var regcount = <?php echo json_encode($regcount); ?>;
    regcount.splice(0,1);
  </script>
  <script src="admin_user_activity_chart.js"></script>

  <script>
    var regyears = <?php echo json_encode($regyears); ?>;
  </script>
  <script src="admin_year_activity_chart.js"></script>

</body>
</html>
