$(document).ready(function() {

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

	$(".panel-menu li").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		panelManage("toggle");
	});

	// LEAFLET

	L.Icon.Default.imagePath = 'built/img';

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png');

	var map = L.map('map');

	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	L.Routing.control({
		plan: L.Routing.plan([
			L.latLng(48.85837009999999, 2.2944813000000295),
			L.latLng(48.851264, 2.3760990000000675)
		], {
			createMarker: function(i, wp) {
				return L.marker(wp.latLng, {
					draggable: false,
				});
			},
		}),
		routeWhileDragging: false
	}).addTo(map);

	map.addLayer(layer);

	$(".leaflet-marker-icon").click(function () {
		alert("test");
		console.log("blop");
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
		$("#mainmenu").fadeIn().css('display','table');
	});
	$("#menu-close").click(function (e) {
		e.preventDefault();
		$("#mainmenu").fadeOut();
	});
});
