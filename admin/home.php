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
          <canvas id="hour_activity_chart"></canvas>
          <canvas id="month_activity_chart"></canvas>
        </div>
        <div class="user_analyse">
          <p style="text-align: center">Απεικόνιση στοιχείων σε χάρτη</p>
          <canvas id="week_activity_chart"></canvas>
          <canvas id="user_activity_chart"></canvas>
          <canvas id="year_activity_chart"></canvas>
        </div>
        <div class="data_load">
          <p style="text-align: center">Διαγραφή/Εξαγωγή δεδομένων</p>
        </div>
      </div>
    </div>


  <script>
    var still = <?php echo $still; ?>;

</script>
<script src="admin_activity_chart.js"></script>

<script src="admin_hour_activity_chart.js"></script>

<script src="admin_month_activity_chart.js"></script>

<script src="admin_week_activity_chart.js"></script>

<script src="admin_user_activity_chart.js"></script>

<script src="admin_year_activity_chart.js"></script>

</body>
</html>
