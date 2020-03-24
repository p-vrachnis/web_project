let baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a>'
    }
)

let cfg = {
    "radius": 40,
    "useLocalExtrema": true,
    valueField: 'price'
};
let heatmapLayer = new HeatmapOverlay(cfg);

let propertyHeatMap = new L.Map('heatmap', {
    center: new L.LatLng(38.230462, 21.753150),
    zoom: 13.3,
    layers: [baseLayer, heatmapLayer]
})

var testData = {
    max: 8,
    data: [{lat: 38.230462, lng: 21.753150, count: 3}]
};

heatmapLayer.setData(testData);