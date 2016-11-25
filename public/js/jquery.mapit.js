
;(function($, window, undefined) {
	"use strict";

	$.fn.mapit = function(options) {

		var defaults = {
			zoom: 			 16,
			type: 			 'ROADMAP',
			scrollwheel: false,
		};

		var options = $.extend(defaults, options, locations);

		$(this).each(function() {

			var $this = $(this);

			// Init Map
			var directionsDisplay = new google.maps.DirectionsRenderer();

			var mapOptions = {
				scrollwheel: options.scrollwheel,
				scaleControl: false,
				fullscreenControl: true,
				center: options.marker.center ? new google.maps.LatLng(options.marker.latitude, options.marker.longitude) : new google.maps.LatLng(options.latitude, options.longitude),
				zoom: options.zoom,
			};
			var map = new google.maps.Map(document.getElementById($this.attr('id')), mapOptions);
			directionsDisplay.setMap(map);

			var radiusLocation = new google.maps.Circle({
	            strokeColor: '#007a87',
	            strokeOpacity: 0.8,
	            strokeWeight: 2,
	            fillColor: '#63d8e0',
	            fillOpacity: 0.35,
	            map: map,
	            center: new google.maps.LatLng(options.marker.latitude, options.marker.longitude),
	            radius: 200
	          });

			// Home Marker
			var home = new google.maps.Marker({
				map: 			map,
				position: new google.maps.LatLng(options.marker.latitude, options.marker.longitude),
				icon: 		new google.maps.MarkerImage(options.marker.icon),
				title: 		options.marker.title
			});

			// Add info on the home marker
			var info = new google.maps.InfoWindow({
				content: options.address
			});

			// Open the info window immediately
			if (options.marker.open) {
				info.open(map, home);
			} else {
				google.maps.event.addListener(home, 'click', function() {
					info.open(map, home);
				});
			};

			// Create Markers (locations)
			var infowindow = new google.maps.InfoWindow();
			var marker, i;
			var markers = [];

			for (i = 0; i < options.locations.length; i++) {
				// Add Markers
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(options.locations[i][0], options.locations[i][1]),
					map: 			map,
					icon: 		new google.maps.MarkerImage(options.locations[i][2] || options.marker.icon),
					title: 		options.locations[i][3]
				});

				// Create an array of the markers
				markers.push(marker);

				// Init info for each marker
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(options.locations[i][4]);
						infowindow.open(map, marker);
					}
				})(marker, i));

			};

			// Directions
			var directionsService = new google.maps.DirectionsService();

			$this.on ('route', function(event, origin) {
				var request = {
					origin: new google.maps.LatLng(options.marker.latitude, options.marker.longitude),
					destination: new google.maps.LatLng(options.origins[origin][0], options.origins[origin][1]),
					travelMode: google.maps.TravelMode.DRIVING
				};
				directionsService.route(request, function(result, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(result);
					};
				});
			});

		});

	};

	$(document).ready(function () { $('[data-toggle="mapit"]').mapit(); });

})(jQuery);

//# sourceMappingURL=jquery.mapit.js.map
