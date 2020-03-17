<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../external/jquery-3.4.1.js"></script>
    <link href="../external/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../map/css/leaflet.css">
    <link rel="stylesheet" href="../external/leaflet/leaflet.css" />
    <script src="../external/jquery-3.4.1.js"></script>
    <title>Leaflet Map</title>
</head>

<body>
  <div class="buttons">
    <input type="file" id="selectFiles" value="Import" />
    <button id="save">Save</button>
    <button id="load">Load</button>
  </div>
    <div id = "map"> </div>

    <script src="../external/leaflet/leaflet.js"></script>
    <script src="../external/leaflet-lasso.umd.min.js"></script>
    <script src="../map/leaflet.js"></script>

</body>
</html>
