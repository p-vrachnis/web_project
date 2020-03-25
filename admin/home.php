<?php
  include "./session.php";
  include "./header.php";
  include "../admin/querys.php";
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
          <p style="text-align: center">Απεικόνιση κατάστασης ΒΔ (dashboard)</p>
          <canvas id="admin_activity_chart"></canvas>
        </div>
        <div class="user_analyse">
          <p style="text-align: center">Απεικόνιση κατάστασης ΒΔ (dashboard)</p>
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
        <div class="data_load">
          <p style="text-align: center">Διαγραφή/Εξαγωγή δεδομένων</p>
        </div>
      </div>
    </div>


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

  <script src="home.js"></script>

</body>
</html>
