$( document ).ready(function() {

	// LEAFLET

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{
	  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
	});
	var map = L.map('map', {
	    scrollWheelZoom: true,
	    center: [48.856614, 2.3522219000000177],
	    zoom: 12
	});

	map.addLayer(layer);

	L.Icon.Default.imagePath = 'built/img';

	var marker = L.marker([48.85837009999999, 2.2944813000000295]).addTo(map);

	$(".leaftlet-marker-icon").click(function (e) {
		alert("HEYHEY");
	});
	

	// SIDE PANEL

	$(".panel-menu .toggle").click(function(e) {
		e.preventDefault();
		$(".side-panel").toggleClass("unfolded");
	});
});
