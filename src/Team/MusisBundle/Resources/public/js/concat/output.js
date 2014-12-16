var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
});

var map = L.map('musisMap', {
    scrollWheelZoom: false,
    center: [40.7127837, -74.0059413],
    zoom: 6
});

map.addLayer(layer);
