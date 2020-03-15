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
    <div id = "map">
      <div class="leaflet-top leaflet-right">
        <div class="leaflet-bar leaflet-control">
          <a class="leaflet-control-lasso" href="#" title="Toggle Lasso" role="button" aria-label="Toggle Lasso"></a>
        </div>
      </div>
    </div>

    <script src="../external/leaflet/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-lasso@2.0.6/dist/leaflet-lasso.umd.min.js"></script>
    <script src="../map/leaflet.js"></script>
    
</body>
</html>
