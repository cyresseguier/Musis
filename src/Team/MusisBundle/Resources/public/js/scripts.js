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
		if ($(this).find(">a.fa-search,>a.fa-play").length) {
			$(this).siblings(".arrow").trigger("click");	
		}
		else {
			$(this).toggleClass("active");
			target = $(this).find(">a").attr("href");
			panelManage("toggle",target);
		}
	});

	// LEAFLET

	L.Icon.Default.imagePath = 'built/img';

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png');

	var map = L.map('map');

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

	map.addLayer(layer);

	//NOT WORKING
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

	//DEEZER PLAYER	

	$("#controlers input").attr('disabled', true);
	$("#slider_seek").click(function(evt,arg){
		var left = evt.offsetX;
		console.log(evt.offsetX, $(this).width(), evt.offsetX/$(this).width());
		DZ.player.seek((evt.offsetX/$(this).width()) * 100);
	});

	function event_listener_append() {
		var pre = document.getElementById('event_listener');
		var line = [];
		for (var i = 0; i < arguments.length; i++) {
			line.push(arguments[i]);
		}
		pre.innerHTML += line.join(' ') + "\n";
	}

	function onPlayerLoaded() {
		$("#controlers input").attr('disabled', false);
		event_listener_append('player_loaded');
		DZ.Event.subscribe('current_track', function(arg){
			event_listener_append('current_track', arg.index, arg.track.title, arg.track.album.title);
		});
		DZ.Event.subscribe('player_position', function(arg){
			event_listener_append('position', arg[0], arg[1]);
			$("#slider_seek").find('.bar').css('width', (100*arg[0]/arg[1]) + '%');
		});
 
		DZ.Event.subscribe('track_end', function() {
			event_listener_append('track_end');
		});
	}
	
	DZ.init({
		appId  : '8',
		channelUrl : 'http://developers.deezer.com/examples/channel.php',
		player : {
			onload : onPlayerLoaded
		}
	});
});

//MUSIS ENGINE MUSIC PART

function loadPlaylist(tab,playlistName){

	var playlist=[];
	for (var i=0; i<tab.length; i++){
		//tab[musics[playlist]][i];
		/*if (tab[musics[playlist]][i]==playlistName){
			playlist.push(tab.musics.link);
			console.log(tab.music.link);
		}*/
	}

	DZ.player.playTracks(playlist); 
	
	return false;
}