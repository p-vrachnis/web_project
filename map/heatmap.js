let baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a>'
    }
)

let cfg = {
    "radius": 30,
    "useLocalExtrema": true,
    "opacity": 0.5
};
let heatmapLayer = new HeatmapOverlay(cfg);

let propertyHeatMap = new L.Map('heatmap', {
    center: new L.LatLng(38.230462, 21.753150),
    zoom: 13.3,
    layers: [baseLayer, heatmapLayer]
})

var testData = {
    data: data_heatmap
};

heatmapLayer.setData(testData);
