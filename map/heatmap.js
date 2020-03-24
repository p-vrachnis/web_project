var mapOptions = {
    center: [38.230462,21.753150],
    zoom: 13.3
 }

 // Creating a map object
 var heatmap = new L.map('heatmap', mapOptions);

 // Creating a Layer object
 var heat_map_layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
 // Adding layer to the map
 heatmap.addLayer(heat_map_layer);