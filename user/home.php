<?php
  include "./session.php";
  include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
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
          </div>
        </div>
        <div class="data_load">
          <?php include "../test/final.php" ?>
        </div>
      </div>
    </div>
</body>
</html>
