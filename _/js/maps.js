jQuery(document).ready(function($) {
	// Enable the visual refresh
	google.maps.visualRefresh = true;

	var map, last_marker = false,
		last_window = false,
		latlng = new google.maps.LatLng(38.6368785,-90.2575685);
	function initialize() {
		var mapOptions = {
			zoom: 16,
			disableDefaultUI: true,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);

	$("#location-list li a").each(function(index) {
		// We'll pass this variable to the PHP function example_ajax_request
		var id = $(this).attr("data-page_id"),
			nonce = $(this).attr("data-nonce");
		 
		// This does the ajax request
		$.ajax({
			type : "post",
			url: SOMAJAX.ajaxurl,
			data: {
				'action':'show_location',
				'id' : id,
				'nonce' : nonce
			},
			success:function(data) {
				var location_obj = jQuery.parseJSON( data ),
					coords_array = location_obj.coords.split(','),
					myLatlng = new google.maps.LatLng( parseFloat(coords_array[0]), parseFloat(coords_array[1]) ),
					image = '/wp-content/themes/som/inc/img/map_marker_closed.png',
					marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: location_obj.title,
						icon: image
					});

				google.maps.event.addListener(marker, 'click', function() {
					show_location_info(id, nonce);
				});
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	}).on("click", function(e) {
		// We'll pass this variable to the PHP function example_ajax_request
		var id = $(this).attr("data-page_id"),
			nonce = $(this).attr("data-nonce");
		 
		show_location_info(id, nonce);
		$('.open').removeClass();
		$(this).parent().addClass('open');
	});

	function show_location_info(i,n) {
		// This does the ajax request
		$.ajax({
			type : "post",
			url: SOMAJAX.ajaxurl,
			data: {
				'action':'show_location',
				'id' : i,
				'nonce' : n
			},
			success:function(data) {
				close_em();
				
				var location_obj = jQuery.parseJSON( data ),
					content = "",
					coords_array = location_obj.coords.split(',');

				if(location_obj.image)
					content += "<img class='loc-image' src=" + location_obj.image + ">";
				content += "<div class='loc-div'><h3>" + location_obj.title + "</h3><p class='loc-p'>" + location_obj.address + "</p>" + location_obj.content + "</div>";
				content += "<form id='get-directions-box' action='http://maps.google.com/maps' method='get'>";
				content += "<input type='text' name='saddr' placeholder='Type your address' id='address'>";
				content += "<input type='hidden' name='daddr' value='" + coords_array[0] + "," + coords_array[1] + "'>";
				content += "<button id='get-directions'>Get Directions</button></form>";

				var	myLatlng = new google.maps.LatLng( parseFloat(coords_array[0]), parseFloat(coords_array[1]) ),
					infowindow = new google.maps.InfoWindow({
						content: content,
						maxWidth: 495
					}),
					image = '/wp-content/themes/som/inc/img/map_marker_open.png',
					marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: location_obj.title,
						icon: image
					});

				google.maps.event.addListener(infowindow,'closeclick',function(){
					close_em();
				});

				infowindow.open(map,marker);
				// save marker/window so we can close them later
				last_marker = marker;
				last_window = infowindow;
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	}

	$('#map-reset').click(function() {
		map.setCenter(latlng);
		map.setZoom(16);
		close_em();
	});

	function close_em() {
		if(last_marker) {
			// close infowindow
			last_window.close();
			last_window = false;
			// remove marker from map
			last_marker.setMap(null);
			last_marker = false;
		}
	}
});