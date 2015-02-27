$(document).ready(function() {

	// SIDE PANEL

	function panelManage(action, target) {
		if (action == "toggle") {
			$(".unfolded:not("+target+")").removeClass("unfolded");
			$(target).toggleClass("unfolded");
		} else if (action == "open") {
			$(".unfolded").removeClass("unfolded");
			$(target).addClass("unfolded");
		} else if (action == "close") {
			$(".unfolded").removeClass("unfolded");
		}
	}

	var target = "";
	$(".panel-menu li").click(function(e) {
		e.preventDefault();
		if ($(this).find(">a.fa-search").length) {
			$(this).siblings(".arrow").trigger("click");	
		}
		else if (!$(this).hasClass("play")) {
			$(this).toggleClass("active");
			target = $(this).find(">a").attr("href");
			panelManage("toggle",target);
		}
	});

	$("li.play").click(function(e) {
		if (DZ.player.isPlaying()) {
			DZ.player.pause();
			$(this).find(">a").removeClass("fa-play");
			$(this).find(">a").addClass("fa-pause");
		} else {
			DZ.player.play();
			$(this).find(">a").removeClass("fa-pause");
			$(this).find(">a").addClass("fa-play");
		}
		return false;
	});

	// LEAFLET

	L.Icon.Default.imagePath = 'built/img';

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png');

	var map = L.map('map');
/*
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);
*/
	L.Routing.control({
		plan: L.Routing.plan(
			[
				L.latLng(48.85837009999999, 2.2944813000000295),
				L.latLng(48.851264, 2.3760990000000675),
				L.latLng(48.85706949999999, 2.359624599999961),
				L.latLng(48.8642701, 2.3534680999999864),
				L.latLng(48.85837009999999, 2.2944813000000295)
			],
			{
				createMarker: function(i, wp) {
					return L.marker(wp.latLng, {
						draggable: false,
					});
				},
			}
		),
		routeWhileDragging: false
	}).addTo(map);
	L.Routing.control({
		plan: L.Routing.plan(
			[
				L.latLng(48.89321700000001, 2.287864000000013),
				L.latLng(48.86244, 2.2491730000000416),
				L.latLng(48.89321700000001, 2.287864000000013),
			],
			{
				createMarker: function(i, wp) {
					return L.marker(wp.latLng, {
						draggable: false,
					});
				},
			}
		),
		routeWhileDragging: false
	}).addTo(map);

	map.addLayer(layer);

	//NOT WORKING
	$(".musisMap .leaflet-marker-icon").click(function () {
		alert("test");
		panelManage("open", "#playlist");
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
