// Lasso
// Handler
interface LassoHandlerOptions {
   polygon?: L.PolylineOptions,
   intersect?: boolean;
}
const lasso = L.lasso(map, mapOptions);
leaflasso.addEventListener('click', () => {
    lasso.enable();
});

// control
type LassoControlOptions = LassoHandlerOptions & L.ControlOptions;

L.control.lasso(mapOptions).addTo(map);

// Finished event
interface LassoHandlerFinishedEventData {
   latLngs: L.LatLng[];
   layers: L.Layer[];
}

map.on('lasso.finished', (event: LassoHandlerFinishedEventData) => {
   console.log(event.layers);
});
