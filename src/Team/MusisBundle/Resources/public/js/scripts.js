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

	var map = L.map('map').setView([48.85, 2.33], 13);

	var wayLayer;

	function createRouting(PlaylistRoute){	
		if (wayLayer!=null) map.removeLayer(wayLayer);
		
		wayLayer=L.Routing.control({
			plan: L.Routing.plan(
				PlaylistRoute,
				{
	        		createMarker: function(i, wp) {
	            		var marker = new L.marker(wp.latLng, {
	                		draggable: false
	            		});
	            		marker.on('click', onClick);
	        			return marker;
	        		}
	    		}),
			addWaypoints: false,
			routeWhileDragging: false
		});

		map.addLayer(wayLayer);
	}

	map.addLayer(layer);

	function onClick(e) {
		//Get Latitude and Longitude of the element clicked
		var Place = this.getLatLng();
		playTrackByPlace(Place);

	}

	function setPlaylistRoute(Playlist){
		var PlaylistRoute=[];
		for(var i=0;i<(Playlist.length);i++){
			PlaylistRoute.push(L.latLng(Playlist[i].places[0].coordLat,Playlist[i].places[0].coordLong));
		}
		// We close the route // WILL IMPROVE
		PlaylistRoute.push(L.latLng(Playlist[0].places[0].coordLat,Playlist[0].places[0].coordLong));
		return PlaylistRoute;
	}
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
		var min,sec;

		for (var i = 0; i < arguments.length; i++) {
			line.push(arguments[i]);
		}
		pre.innerHTML += line.join(' ') + "\n";
		min=Math.floor(arguments[1]/60);
		sec=Math.floor(arguments[1])%60;

		if(sec<10) sec="0"+sec;

		// Show position if only you got numeric value (time song) 
		if (!isNaN(min)||!isNaN(sec))
			$("#song-info .position").text(min+":"+sec);
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

	function playPlaylist(Playlist){
		var playlistLink=[];

		for (var i=0; i<Playlist.length; i++){
			playlistLink.push(Playlist[i].link);
		}

		console.log(playlistLink);
		DZ.player.playTracks(playlistLink); 
	}	
	
	function playTrackByPlace(Place){
		for (var i=0; i<globalPlaylist.length; i++){
			//console.log(Place.lng);
			//console.log(globalPlaylist[i].places[0].coordLong);

			if(globalPlaylist[i].places[0].coordLong==Place.lng){
				switchTrack(i,DZ.player.getCurrentIndex());
				alert(globalPlaylist[i].title);
			}
		}
	}

	// TO IMPROVE
	function switchTrack(id,position){
		console.log(id,position);

		if (id>position){
			for(var i=position;i<id;i++){
				DZ.player.next();
			}
		}
		
		if(id<position){
			for(var j=id;j<position;j++){
				DZ.player.prev();
			}
		}
	}

	//MUSIS ENGINE MUSIC PART
	var globalPlaylist=[];

	window.loadPlaylist = function(tab,playlistName){
		var playlist=[];
		for (var i=0; i<tab.length; i++){
			for (var j=0; j<tab[i].playlists.length; j++){
				if (tab[i].playlists[j].name==playlistName){
					playlist.push(tab[i]);
				}
			}
		}

		playPlaylist(playlist);

		PlaylistRoute=setPlaylistRoute(playlist);
		createRouting(PlaylistRoute);
		
		globalPlaylist=playlist;
		return playlist;
	};

});

