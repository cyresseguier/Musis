$(document).ready(function() {

	// ENTER

	$(".main-menu a").click(function() {
		$("#intro").addClass("disabled");
		welcome();
	});

	// INTRO SCROLL

	$("#begin").click(function () {
		$("#intro").addClass("disabled");
		$(".side-panel").addClass("visible");
		welcome();
		panelManage("open","#panel-content");

	});

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
	            		marker.on('mouseover',Hover);
	            		marker.on('mouseout',onOut);
	        			return marker;
	        		}
	    		}),
			addWaypoints: false,
			routeWhileDragging: false,
			lineOptions: {
	            styles: [
	            {color: '#3F7079', opacity: 1,weight: 1}
	            ]
           }
		});

		map.addLayer(wayLayer);
	}

	map.addLayer(layer);

	function onClick(e) {
		//Get Latitude and Longitude of the element clicked
		var place = this.getLatLng();
		playTrackByPlace(place);

	}

	function Hover(e) {
		var place = this.getLatLng();
		var text = popPlace(place);
		this.bindPopup(text.title+' - '+text.artists[0].name).openPopup();
	}

	function onOut(e) {
		this.closePopup();
	}

	function popPlace(Place){
		for (var i=0; i<globalPlaylist.length; i++){
			if(globalPlaylist[i].places[0].coordLong==Place.lng){
				return globalPlaylist[i];
			}
		}
	}

	function setPlaylistRoute(Playlist){
		var PlaylistRoute=[];
		for(var i=0;i<(Playlist.length);i++){
			PlaylistRoute.push(L.latLng(Playlist[i].places[0].coordLat,Playlist[i].places[0].coordLong));
		}
		PlaylistRoute.push(L.latLng(Playlist[0].places[0].coordLat,Playlist[0].places[0].coordLong));
		return PlaylistRoute;
	}


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
			$(".trackInfos").removeClass("active");
			$("#trackListing").find("li").eq(arg.index).addClass("active");

			$("#song-info .title").text(arg.track.title+" - "+arg.track.artist.name);
			min=Math.floor(arg.track.duration/60);
			sec=Math.floor(arg.track.duration%60);

			if(sec<10) sec="0"+sec;
			if (!isNaN(min)||!isNaN(sec))
				$("#song-info .length").text(min+":"+sec);
		});
		DZ.Event.subscribe('player_position', function(arg){
			event_listener_append('position', arg[0], arg[1]);
			$("#slider_seek").find('.bar').css('width', (100*arg[0]/arg[1]) + '%');
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
		DZ.player.playTracks(playlistLink); 

	}	
	
	function playTrackByPlace(Place){
		for (var i=0; i<globalPlaylist.length; i++){
			if(globalPlaylist[i].places[0].coordLong==Place.lng){
				switchTrack(i,DZ.player.getCurrentIndex());
			}
		}
	}

	// TO IMPROVE
	function switchTrack(id,position){
		$(".trackInfos").removeClass("active");
		$("#trackListing").find("li").eq(id).addClass("active");
		
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
		var citation;

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
	
		citation = playlist[Math.floor(Math.random()*playlist.length)];

		$("#trackListing").find("li").eq(0).addClass("active");
		$("#citation").html(citation.lyrics);
		$(".author").html('- '+citation.artists[0].name);

		return playlist;
	};

	//AJAX
	function welcome(){
		$.ajax({
	    	url : Routing.generate('team_musis_welcome'), 
	    	type : 'GET', 
	    	dataType : 'html',

			success: function(data) { 
				$('#panel-content').html(data);
				$(".toAllParcours").click(function(e){
					toAllParcours();			
				});
			}
		});
	}

	function toAllParcours(){
		$.ajax({
	    	url : Routing.generate('team_musis_listallplaylist'), 
	    	type : 'GET', 
	    	dataType : 'html',

			success: function(data) { 
				$('#searchElement').html(data);
				panelManage("close","#panel-content");
				panelManage("open","#searchElement");
				$(".listAllParcours").click(function(e){
					listAllParcours(this);			
				});
			}
		});

	}

	function listAllParcours(elt){
		var playlistName=elt.id;

	    $.ajax({
	    	url : Routing.generate('team_musis_parcours',{ 'name':playlistName }), 
	    	type : 'GET', 
	    	dataType : 'html',

			success: function(data) { 
				$('#panel-content').html(data); 
				panelManage("close","#searchElement");
				panelManage("open","#panel-content");
				
				loadPlaylist(musics,playlistName); 

				//Interface
				$(".trackInfos").click(function(e){
					switchTrack(this.id,DZ.player.getCurrentIndex());
					
				});
				$(".toAllParcours").click(function(e){
					toAllParcours();			
				});
			}
		});
	}

	//NAVIGATION
	$('#mainmenu .accueil').click(function(e){
		welcome();
		panelManage("close","#searchElement");
		panelManage("open","#panel-content");
	});
});

