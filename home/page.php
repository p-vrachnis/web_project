<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="/external/jquery-3.4.1.js"></script>
    <link href="/external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/home/style.css">
</head>

<body>
    <div class="design">
        <div id="top-header">
            <p>Welcome to the Home Page!</p>
        </div>
        <form id="logout" class="input-group" name="logout_form" action="/home/logout.php" method="POST">
          <button id="btnLogout" type="submit" name="submit" class="btn btn-success btn-lg">Log out</button>
        </form>
    </div>
</body>
</html>
