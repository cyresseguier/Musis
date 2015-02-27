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

	// PLAYER
	
	var playerButton = "";
	$("li.play").click(function(e) {
		playerButton = $(this).find(">a");
		if (DZ.player.isPlaying()) {
			DZ.player.pause();
			playerButton.removeClass("fa-play").addClass("fa-pause");
		} else {
			DZ.player.play();
			playerButton.removeClass("fa-pause").addClass("fa-play");
		}
		return false;
	});


	// LEAFLET

	L.Icon.Default.imagePath = 'built/img';

	var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png');

	var map = L.map('map');


	var container=L.Routing.control({
		plan: L.Routing.plan(
			[
				L.latLng(48.85837009999999, 2.2944813000000295),
				L.latLng(48.851264, 2.3760990000000675),
				L.latLng(48.85706949999999, 2.359624599999961),
				L.latLng(48.85837009999999, 2.2944813000000295)
			],
			{
        		createMarker: function(i, wp) {
            		return L.marker(wp.latLng, {
                	draggable: false
            		}).bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        		}
    		}),
		addWaypoints: false,
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


	//var marker = L.marker([48.8642701, 2.3534680999999864]).addTo(map);

	map.addLayer(layer);
	
	//NOT WORKING
	/*$(".leaflet-marker-icon").click(function () {
		alert("test");
		panelManage("open", "#playlist");
		DZ.player.playAlbum(302127);
	});*/

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
		$("#song-info .position").text(Math.floor(arguments[1]/60)+":"+(Math.floor(arguments[1])%60));
	}

	function onPlayerLoaded() {
		$("#controlers input").attr('disabled', false);
		event_listener_append('player_loaded');
		DZ.Event.subscribe('current_track', function(arg){
			event_listener_append('current_track', arg.index, arg.track.title, arg.track.album.title);
			$("#song-info .title").text(arg.track.artist.name+" - "+arg.track.title);
			$("#song-info .length").text(Math.floor(arg.track.duration/60)+":"+(arg.track.duration%60));
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
		for (var j=0; j<tab[i].playlists.length; j++){
			if (tab[i].playlists[j].name==playlistName){
				playlist.push(tab[i].link);
			}
		}
	}
	DZ.player.playTracks(playlist); 
	
	return false;
}
