    // Create the base Leaflet layer (the map itself)
    let baseLayer = L.tileLayer(
      'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a>'
      }
    )

    // Configure and create the heatmap.js layer
    let cfg = {
        "radius": 30,
        "useLocalExtrema": true,
        "opacity": 0.5
    }

    let heatmapLayer = new HeatmapOverlay(cfg)

    // Create the overall Leaflet map using the two layers we created
    let propertyHeatMap = new L.Map('map', {
      center: new L.LatLng(38.230462, 21.753150),
      zoom: 13.3,
      layers: [baseLayer, heatmapLayer]
    })

    var testData = {
        data: [{ lat:38.230462, lng:21.753150}] //data_heatmap
    };
    
    // Add data (from sales.js file) to the heatmap.js layer
    heatmapLayer.setData(testData);
