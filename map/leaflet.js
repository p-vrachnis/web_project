//???????
var markers = [];

// JSON file to JAVASCRIPT
document.getElementById('load').onclick = function(){
    if (!Array.isArray(markers) || !markers.length) {
      var files = document.getElementById('selectFiles').files;
      console.log(files);

      if(files.length <= 0){
          return false;
      }

      var fr = new FileReader();
      fr.readAsText(files.item(0));
      fr.onload = function(e){

          var result = JSON.parse(e.target.result);

          // Show all Coordinates from JSON file into the leaflet map.
          for (var i=0; i<result.locations.length; i++){
              var lat = result.locations[i].latitudeE7;
              var lon = result.locations[i].longitudeE7;
              if(arePointsNear([lat,lon],[38230462,21753150],10000)){
                var timestamp = result.locations[i].timestampMs;
                if(typeof result.locations[i].activity != "undefined") {
                  var activity = result.locations[i].activity[0].activity[0].type;
                }else{
                  var activity = null;
                }
                showMarker(lat, lon, timestamp, activity);
              }
          }
          fr.abort();
      }
  }else{
    alert("Markers exist, load denied");
  }
};

//check if within kilometers
function arePointsNear(checkPoint, centerPoint, km) {
  var ky = 40000 / 360;
  var kx = Math.cos(Math.PI * centerPoint[0] / 180.0) * ky;
  var dx = Math.abs(centerPoint[1] - checkPoint[1]) * kx;
  var dy = Math.abs(centerPoint[0] - checkPoint[0]) * ky;
  return Math.sqrt(dx * dx + dy * dy) >= km;
}

// Creating map options
var mapOptions = {
    center: [38.230462,21.753150],
    zoom: 13.3
 }

 // Creating a map object
 var map = new L.map('map', mapOptions);

 // Creating a Layer object
 var map_layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
 // Adding layer to the map
 map.addLayer(map_layer);

 // Function which converts number to a string and inserting a decimal point in the third place of it.
 function insertDecimal(num) {
    snum = num.toString();
    return snum.slice(0, 2) + "." + snum.slice(2);
 }
// Function which show the position (Marker) of the user on the Map Layer.
function showMarker(latitude, longitude, timestamp, activity){

    lat = insertDecimal(latitude);
    lon = insertDecimal(longitude);
    var mymarker = L.marker([lat,lon]);
    mymarker._id = timestamp;
    mymarker.activity = activity;
    mymarker.addTo(map);
    markers.push(mymarker);
    var popupContent =
        '<p>Do you want to delete this marker?</p>' +
        '<button onclick=deleteMarker(' + mymarker._id + ')>Delete Marker</button>';

    var markerPopup = mymarker.bindPopup(popupContent, {
        closeButton: false
    });
}

function notContainsMarker(obj, list) {
    for (var i = 0; i < list.length; i++) {
        if (list[i]._id === obj._id) {
          return false;
        }
    }
    return true;
}

function deleteMarker(id){
    console.log(markers);
    var new_markers = [];
    markers.forEach(function(mymarker){
        if (mymarker._id == id)
            map.removeLayer(mymarker);
        else
            new_markers.push(mymarker);
    });
    markers = new_markers;
}


//save button
document.getElementById('save').onclick = function(){
  alert("i will save to database");
};

//--------------------------------------------------------------------- lasso

const lassoControl = L.control.lasso().addTo(map);

function resetSelectedState() {
    map.eachLayer(layer => {
      if (layer instanceof L.Marker) {
        layer.setIcon(new L.Icon.Default());
      }
    });

}
var test_icon = L.icon({
    iconUrl: '../images/marker-icon_red.png',
});

function setSelectedLayers(layers) {
    layers.forEach(marker => {
      //marker.setIcon(new L.Icon.Default({ className: 'selected '}));
      marker.setIcon(test_icon);
    });
}


map.on('lasso.enabled', () => {
  resetSelectedState();
});

var del_markers=[];
map.on('lasso.finished', event => {
    del_markers = event.layers;
    setSelectedLayers(del_markers);
    if (del_markers && del_markers.length) {
      map.once("click", function(e) {
        if (del_markers.length==1){
          var popupContent =
              '<p>Do you want to delete this marker?</p>' +
              '<button onclick=deleteSelectedMarkers()>Delete Marker</button>';
        }else{
          var popupContent =
              '<p>Do you want to delete these markers?</p>' +
              '<button onclick=deleteSelectedMarkers()>Delete Markers</button>';
        }
        L.popup({closeButton: false}).setLatLng([e.latlng.lat, e.latlng.lng]).setContent(popupContent).openOn(map);
      });
    }
});

function deleteSelectedMarkers() {
    markers = $.grep(markers, function(el){return $.inArray(el, del_markers) == -1});
    del_markers.forEach(function(marker){
      map.removeLayer(marker);
    });
    map.closePopup();
}

map.on("mousedown", function(e) {
  resetSelectedState();
});

// mouseEventToLatLng

toggleLasso.addEventListener('click', () => {
    if (lassoControl.enabled()) {
        lassoControl.disable();
    } else {
        lassoControl.enable();
    }
});
