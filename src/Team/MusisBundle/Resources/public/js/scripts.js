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

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png');
	var map = L.map('map', {
		layers: MQ.mapLayer(),
		scrollWheelZoom: false,
		center: [48.856614, 2.3522219000000177],
		zoom: 12
	});
	var dir = MQ.routing.directions();

	dir.optimizedRoute({
		locations: [
			'Avenue des champs-élysées, Paris, France',
			'Rue Pierre Semard, Paris, France',
			'Place de la Bastille, Paris, France',
			'Avenue des champs-élysées, Paris, France',
		],
		options: {
			routeType: 'bicycle',
			avoids: [
				'Toll Road',
				'Limited Access'
			],
			locale: 'fr_FR',
			unit: 'k'
		}
	});

	map.addLayer(layer);
	map.addLayer(MQ.routing.routeLayer({
		draggable: false,
		ribbonOptions: {
			ribbonDisplay: {color: '#3b7075', opacity: '0.7'},
		},
		directions: dir,
		fitBounds: true,
	}));

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
