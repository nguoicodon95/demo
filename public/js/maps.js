var side_bar_html = "";
var gmarkers = [];
var htmls = [];
var i = 0;

var display_infowindow = false;

var _icon = {
  path: 'M 1 1 L 1 1 L 1 1 L 1 1 z'
}

function createMarker(point, name, html, id, money) {
  var infoWindow = new google.maps.InfoWindow();

  var marker = new MarkerWithLabel({
     position: point,
     map: map,
     icon: _icon,
     labelContent: money+" <sup>đ</sup>",
     labelAnchor: new google.maps.Point(22, 0),
     labelClass: "labels labels-"+id, 
     labelStyle: {opacity: 1},
   });

  closeInfoWindow = function() {
    infoWindow.close();
  };

  var contentString = '<div class="col-1g-12">'+
                  ' <div class="listing-room">' +
                    '<div class="listing-img">' +
                      '<a href="" target="_blank">' +
                        '<div class="listing-img-cover" data-idroom-maps="listing-room-map-1" id="listing-room-map-1">' +
                          '<div class="d-slider">' +
                            '<img height="236" src="http://www.hotel-grandmajestic.cz/files/hotel/rooms/hotel-majestic-prague-double-room-01.jpg" alt="">' +
                          '</div>' +
                          '<div class="d-slider">' +
                            '<img height="236" src="http://www.hotel-grandmajestic.cz/files/hotel/rooms/hotel-majestic-prague-deluxe-suite-01.jpg" alt="">' +
                          '</div>' +
                          '<div class="d-slider">' +
                            '<img height="236" src="http://www.hotel-grandmajestic.cz/files/hotel/rooms/hotel-majestic-prague-double-room-05.jpg" alt="">' +
                          '</div>' +
                          
                          '<div class="overlay-panel">' +
                            '<div class="price-panel">' +
                              '<span class="price-number">' +
                                money +
                              '</span>' +
                              '<span class="curently"><sup>VNĐ</sup></span>' +
                            '</div>' +
                          '</div>' +
                          '<div class="favorite">' +
                            '<input type="checkbox" checked id="wishlist-maps-widget-1" name="wishlist-widget-1">' +
                          '</div>' +
                        '</div>' +
                      '</a>' +

                      '<div id="next-listing-room-map-1" class="control control_next"><span class="fa fa-toggle-right"></span></div>' +
                      '<div id="prev-listing-room-map-1" class="control control_prev"><span class="fa fa-toggle-left"></span></div>' +
                    '</div>' +
                    '<div class="room-panel-body">'+
                      '<div class="media">'+
                        '<h3 title="King Hotel" class="truncate">'+
                          '<a href="">'+ name +'</a>'+
                        '</h3>'+
                        '<a href="" class="practical">'+
                          '<div class="truncate room-partials">'+
                            '<span>Phòng riêng</span>'+
                            '<span>'+
                              '<span class="fa fa-circle"></span>'+
                              '<span>2 người</span>'+
                            '</span>'+
                            '<span>'+
                              '<span class="fa fa-circle"></span>' +
                              '<span>50 phản hồi</span>'+
                            '</span>'+
                          '</div>'+
                        '</a>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';



  google.maps.event.addListener(map, 'click', closeInfoWindow);

  google.maps.event.addListener(marker, "click", function() {
    infoWindow.setContent(contentString);
    if( display_infowindow ) {
      display_infowindow.close();
    }
    display_infowindow = infoWindow;
    infoWindow.open(map, marker);
    
    Slidermaps();

    $('.labels-'+id).css({
        'background': '#bd4721',
        'z-index': '999999'
    })

  });

  google.maps.event.addListener(marker, "hover", function() {
    $('.labels-'+id).css({
        'background': '#bd4721',
        'z-index': '999999'
    })
  });

  gmarkers[i] = marker;

  htmls[i] = html;

  i++;
  return marker;
}

function mouseoverIcon(i) {
  $('.labels-'+i).css({
      'background': '#276882',
      'z-index': '9999'
  })
}

function mouseoutIcon(i) {
  $('.labels-'+i).css({
      'background': '#ff5a5f',
      'z-index': '1'
  })
}

function myclick(i) {
  $('.labels-'+i).css({
      'background': '#337ab7'
  })
}
  
function showVisibleMarkers() {
  var bounds = map.getBounds();
  count = 0;

  for (var i = 0; i < gmarkers.length; i++) {
    var marker = gmarkers[i],
    infoPanel = $('.place-' + i );

    if(bounds.contains(marker.getPosition())===true) {
      infoPanel.show();
      count++;
    }
    else {
      infoPanel.hide();
    }
  }

  $('#infos h2 span').html(count);
}

function initMap() {

  var main_color = '#2d313f',
      saturation_value= -10,
      brightness_value= 5;


  map = new google.maps.Map(document.getElementById('map'), {
    center: center,
    zoom: zoom,
    panControl: false,
    zoomControl: false,
    mapTypeControl: false,
    streetViewControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    // styles: style
  });

  addMarkers();
  
  google.maps.event.addListener(map, 'idle', function() {
    showVisibleMarkers();
  });

}

function addMarkers() {
  $.get( "/map-data.json", function( data ) {
    for (var i = 0; i < data.markers.length; i++) {
      var point = new google.maps.LatLng(data.markers[i].lat, data.markers[i].lng);
      var place_id = data.markers[i].place_id;
      var marker = createMarker(point, data.markers[i].label, data.markers[i].html, place_id, data.markers[i].money);
      marker.setMap(map);
      
      gmarkers.push(marker);
    }
  });
}

window.onload = function() {
    initMap();
};

//slider map

function Slidermaps() {
  $('.listing-img-cover').each(function(k, v) {
      
    var slidermapsid = $(v).attr('data-idroom-maps');

    $('#' + slidermapsid + ', #next-' + slidermapsid + ', #prev-' + slidermapsid).on('mouseover', function () {
      $('#next-' + slidermapsid + ', #prev-' + slidermapsid).css({
        'opacity': '0.8'
      })
    });

    $('#'+slidermapsid).on('mouseout', function () {
      $('#next-' + slidermapsid + ', #prev-' + slidermapsid).css({
        'opacity': '0'
      })
    });

      var currentIndex = 0,
      items = $('#'+slidermapsid+' div.d-slider'),
      itemAmt = items.length;


      $('#next-'+slidermapsid).click(function() {
        currentIndex += 1;
      if (currentIndex > itemAmt - 1) {
          currentIndex = 0;
      }
      cycleItems(slidermapsid, currentIndex, items);
    });


    $('#prev-'+slidermapsid).click(function() {
        currentIndex -= 1;
      if (currentIndex < 0) {
          currentIndex = itemAmt - 1;
      }
      cycleItems(slidermapsid, currentIndex, items);
    });

    cycleItems(slidermapsid, currentIndex, items);
  });
}

function cycleItems(slidermapsid, currentIndex, items) {
  var item = $('#'+slidermapsid+' div.d-slider').eq(currentIndex);
  items.hide();
  item.css('display','inline-block');
}
//# sourceMappingURL=maps.js.map
