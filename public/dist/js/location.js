  var placeSearch, autocomplete;

  var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name',
      administrative_area_level_2: 'long_name'
  };

  var input = document.getElementById('get-location-address');

  $(document).ready(function() {

      var lat = document.getElementById('latitude').value;
      var lng = document.getElementById('longitude').value;

      if (lat != '' && lng != '') {
          var center = { lat: parseFloat(lat), lng: parseFloat(lng) };
      } else {
          var center = { lat: 16.054831, lng: 108.201169 };
      }

      var map = new google.maps.Map(document.getElementById('map'), {
          center: center,
          zoom: 14,
          scrollwheel: false,
      });
      var geocoder = new google.maps.Geocoder();

      $('#get-location-address').keyup(function() {
          setTimeout(function() {
              geocodeAddress(geocoder, map);
          }, 3000);
      });

      var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          position: center,
      });


      var autocomplete = new google.maps.places.Autocomplete(
          input, { types: ['geocode'] }
      );

      autocomplete.bindTo('bounds', map);

      autocomplete.addListener('place_changed', function() {

          marker.setVisible(false);

          var place = autocomplete.getPlace();

          if (!place.geometry) {
              geocodeAddress(geocoder, map);
          } else {
              setAtt(place);
          }

          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
              map.setZoom(14);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(14);
          }

          marker.setPosition(place.geometry.location);

          marker.setVisible(true);

          var address = '';

          if (place.address_components) {
              address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
              GetLocation(input.value);
          }

      });

      google.maps.event.addListener(marker, 'dragend', function() {
          var ps = marker.getPosition();
          var latlng = { lat: parseFloat(ps.lat()), lng: parseFloat(ps.lng()) };
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'location': latlng }, function(results, status) {
              if (status === 'OK') {
                  input.value = results[1].formatted_address;
                  GetLocation(results[1].formatted_address);
                  setAtt(results[1]);
              }
          });
      });

  });

  function geocodeAddress(geocoder, resultsMap) {
      var address = document.getElementById('get-location-address').value;
      geocoder.geocode({ 'address': address }, function(results, status) {
          if (status === 'OK') {
              resultsMap.setCenter(results[0].geometry.location);
              var latitude = results[0].geometry.location.lat();
              var longitude = results[0].geometry.location.lng();
              document.getElementById("latitude").value = latitude;
              document.getElementById("longitude").value = longitude;
          } else {
              console.log('Geocode was not successful for the following reason: ' + status);
          }
      });
  }

  function GetLocation(id) {
      var geocoder = new google.maps.Geocoder();
      var _address = id;

      geocoder.geocode({ 'address': _address }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              var latitude = results[0].geometry.location.lat();
              var longitude = results[0].geometry.location.lng();
              document.getElementById("latitude").value = latitude;
              document.getElementById("longitude").value = longitude;
          } else {
              alert("Không thể tìm thấy vị trí bạn yêu cầu.")
          }
      });
  }


  function setAtt(place) {
      for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType).value = val;
          }
      }
  }