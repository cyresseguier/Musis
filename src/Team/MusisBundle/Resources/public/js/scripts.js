$( document ).ready(function() {

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{
	  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
	});
	var map = L.map('map', {
	    scrollWheelZoom: true,
	    center: [48.856614, 2.3522219000000177],
	    zoom: 12
	});

	map.addLayer(layer);

	$(".panel-menu .toggle").click(function(e) {
		e.preventDefault();
		$(".side-panel").toggleClass("unfolded");
	});
});
