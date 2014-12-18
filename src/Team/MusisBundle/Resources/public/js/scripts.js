$( document ).ready(function() {

	// SIDE PANEL

	function panelManage(action) {
		if (action == "toggle") {
			$(".side-panel").toggleClass("unfolded");
		} else if (action == "open") {
			$(".side-panel").addClass("unfolded");
		} else if (action == "close") {
			$(".side-panel").removeClass("unfolded");
		}
	}

	$(".panel-menu .toggle").click(function(e) {
		e.preventDefault();
		panelManage("toggle");
	});

	// LEAFLET

	L.Icon.Default.imagePath = 'built/img';

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{
	  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
	});
	var map = L.map('map', {
	    scrollWheelZoom: false,
	    center: [48.856614, 2.3522219000000177],
	    zoom: 12
	});

	map.addLayer(layer);

	var tourEiffel = L.marker([48.85837009999999, 2.2944813000000295]).addTo(map);
	var tuileries = L.marker([48.8634916, 2.327494300000012]).addTo(map);

	var itineraire1 = [
	  [48.85837009999999, 2.2944813000000295],
	  [48.8634916, 2.327494300000012]
	];

	var it1_path = L.polyline(itineraire1);
	it1_path.addTo(map);

	$(".leaflet-marker-icon").click(function (e) {
		panelManage("open");
		DZ.player.playAlbum(302127);
	});

	// INTRO SCROLL

	$("#begin").click(function () {
		$("#intro").addClass("disabled");
		$(".side-panel").addClass("visible");
	});

	//FULLSCREEN MENU

	$("#menu-open").click(function (e) {
		e.preventDefault();
		$("#mainmenu").fadeIn();
	});
	$("#menu-close").click(function (e) {
		e.preventDefault();
		$("#mainmenu").fadeOut();
	});
});
