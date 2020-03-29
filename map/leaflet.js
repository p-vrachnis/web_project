//???????
var markers = [];

// JSON file to JAVASCRIPT
document.getElementById('load').onclick = function(){
    if (!Array.isArray(markers) || !markers.length) {
      var files = document.getElementById('selectFiles').files;

      if(files.length <= 0){
          return false;
      }

      var fr = new FileReader();
      fr.readAsText(files.item(0));
      fr.onload = function(e){

          var result = JSON.parse(e.target.result);

          // Show all Coordinates from JSON file into the leaflet map.
          for (var i=0; i<result.locations.length; i++){
              var lat = insertDecimal(result.locations[i].latitudeE7);
              var lon = insertDecimal(result.locations[i].longitudeE7);

              if(distance([lat,lon],[38.230462,21.753150]) <= 10){
                var timestamp = result.locations[i].timestampMs;
                if(typeof result.locations[i].accuracy != "undefined") {
                  var accuracy = result.locations[i].accuracy;
                }else{
                  var accuracy = null;
                }
                if(typeof result.locations[i].altitude != "undefined") {
                  var altitude = result.locations[i].altitude;
                }else{
                  var altitude = null;
                }
                if(typeof result.locations[i].velocity != "undefined") {
                  var velocity = result.locations[i].velocity;
                }else{
                  var velocity = null;
                }
                if(typeof result.locations[i].verticalAccuracy != "undefined") {
                  var verticalAccuracy = result.locations[i].verticalAccuracy;
                }else{
                  var verticalAccuracy = null;
                }
                if(typeof result.locations[i].heading != "undefined") {
                  var heading = result.locations[i].heading;
                }else{
                  var heading = null;
                }
                if(typeof result.locations[i].activity != "undefined") {
                  var activity = result.locations[i].activity[0].activity[0].type;
                  var act_timestampMs = result.locations[i].activity[0].timestampMs;
                  var act_confidence = result.locations[i].activity[0].activity[0].confidence;
                }else{
                  var activity = null;
                  var act_timestampMs = null;
                  var act_confidence = null;
                }
                showMarker(timestamp, lat, lon, accuracy, altitude, velocity, verticalAccuracy, heading, activity, act_timestampMs, act_confidence);
              }
          }
          fr.abort();
      }
  }else{
    alert("Markers exist, load denied");
  }
};

// distance between point and center
function distance(point, center) {
  var p = 0.017453292519943295;    // Math.PI / 180
  var c = Math.cos;
  var a = 0.5 - c((center[0] - point[0]) * p)/2 +
          c(point[0] * p) * c(center[0] * p) *
          (1 - c((center[1] - point[1]) * p))/2;

  return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
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
function showMarker(timestamp, latitude, longitude, accuracy, altitude, velocity, verticalAccuracy, heading, activity, act_timestampMs, act_confidence){
    var mymarker = L.marker([latitude,longitude]);
    mymarker._id = timestamp;
    mymarker.accuracy = accuracy;
    mymarker.altitude = altitude;
    mymarker.velocity = velocity;
    mymarker.verticalAccuracy = verticalAccuracy;
    mymarker.heading = heading;
    mymarker.activity = activity;
    mymarker.act_timestampMs = act_timestampMs;
    mymarker.act_confidence = act_confidence;
    mymarker.addTo(map);
    markers.push(mymarker);
    var popupContent =
        '<p>Do you want to delete this marker?</p>' +
        '<button onclick=deleteMarker(' + mymarker._id + ')>Delete Marker</button>';

    var markerPopup = mymarker.bindPopup(popupContent, {
        closeButton: false
    });
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
  if (markers.length != 0) {
  var dbArray = [];
  var tempArray = [];
  for( var i = 0; i<markers.length; i++){
    timestamp = markers[i]._id;

    lat =  parseInt(markers[i]._latlng.lat.toFixed(7).toString().replace(".", ""),10);
    lng =  parseInt(markers[i]._latlng.lng.toFixed(7).toString().replace(".", ""),10);
    accuracy = markers[i].accuracy;
    altitude = markers[i].altitude;
    velocity = markers[i].velocity;
    verticalAccuracy = markers[i].verticalAccuracy;
    heading = markers[i].heading;
    activity = markers[i].activity;
    act_timestampMs = markers[i].act_timestampMs;
    act_confidence = markers[i].act_confidence;

    tempArray.push(timestamp);
    tempArray.push(lat);
    tempArray.push(lng);
    tempArray.push(accuracy);
    tempArray.push(altitude);
    tempArray.push(velocity);
    tempArray.push(verticalAccuracy);
    tempArray.push(heading);
    tempArray.push(activity);
    tempArray.push(act_timestampMs);
    tempArray.push(act_confidence);

    dbArray.push(tempArray);

    tempArray = [];
  }
  console.log(dbArray);

  dbArray = JSON.stringify(dbArray)
  $.ajax({
    data: 'data=' + dbArray,
    url: '../map/save.php',
    method: 'POST', // or GET
    success: function(msg) {
        alert(msg);
        location.reload();
    }
});

  }else{
    alert("No data to save");
  }
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
