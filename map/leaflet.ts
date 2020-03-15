showMarker(382093172, 217131794, 1);
const layers = [
    markers,
];
const lassoControl = L.control.lasso().addTo(map);
function resetSelectedState() {
    map.eachLayer(layer => {
        if (layer instanceof L.Marker) {
            layer.setIcon(new L.Icon.Default());
        } else if (layer instanceof L.Path) {
            layer.setStyle({ color: '#3388ff' });
        }
    });

}
function setSelectedLayers(layers) {
    resetSelectedState();

    layers.forEach(layer => {
        if (layer instanceof L.Marker) {
            layer.setIcon(new L.Icon.Default({ className: 'selected '}));
        } else if (layer instanceof L.Path) {
            layer.setStyle({ color: '#ff4620' });
        }
    });
}

map.on('mousedown', () => {
    resetSelectedState();
});
map.on('lasso.finished', event => {
    setSelectedLayers(event.layers);
});
map.on('lasso.enabled', () => {
    resetSelectedState();
});
