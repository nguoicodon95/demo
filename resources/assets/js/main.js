/**
*	Working: Loading page
*	Created: 7/8/2016
*	Author: Nhat Pham
**/

jQuery(function ($) { 
	window.onload = function () {
		document.getElementById('loading-mask').style.display = 'none';
	}
	$('body').append('<div class="ui-datepicker-backdrop"></div>');
});


$(function() {
	$('.zone').each(function(index, el) {
		var zoneBackground = $(el).attr('zone-url');
		$(el).css({
			'background-image': 'url('+ zoneBackground +')',
			'background-size': 'cover',
			'background-repeat': 'no-repeat',
			'background-position': 'center center',
			'position': 'relative'
		});
	});

	$("#range_price").ionRangeSlider({
		type: "double",
		min: 230000,
		max: 25000000,
		grid: true,
		force_edges: true
	});

	function setHeight() {
        windowHeight = $(window).innerHeight();
        topHeight = $('header .navigation').innerHeight();
        var height = (windowHeight-topHeight);
        $('#map').css('height', height);
    };
    setHeight();
      
    $(window).resize(function() {
        setHeight();
    });
});


$(document).ready(function() {

	$('.listing-img-cover').each(function(k, v) {
			
		var sliderid = $(v).attr('data-idroom');
		
		$('#' + sliderid + ', #next-' + sliderid + ', #prev-' + sliderid).on('mouseover', function () {
			$('#next-' + sliderid + ', #prev-' + sliderid).css({
				'opacity': '0.8'
			})
		});
		$('#'+sliderid).on('mouseout', function () {
			$('#next-' + sliderid + ', #prev-' + sliderid).css({
				'opacity': '0'
			})
		});

	   	var currentIndex = 0,
	  	items = $('#'+sliderid+' div.d-slider'),
	  	itemAmt = items.length;


  		$('#next-'+sliderid).click(function() {
		  	currentIndex += 1;
			if (currentIndex > itemAmt - 1) {
			    currentIndex = 0;
			}
			cycleItems(sliderid, currentIndex, items);
		});


		$('#prev-'+sliderid).click(function() {
		  	currentIndex -= 1;
			if (currentIndex < 0) {
			    currentIndex = itemAmt - 1;
			}
			cycleItems(sliderid, currentIndex, items);
		});

		cycleItems(sliderid, currentIndex, items);
	});


	function cycleItems(sliderid, currentIndex, items) {
	  var item = $('#'+sliderid+' div.d-slider').eq(currentIndex);
	  items.hide();
	  item.css('display','inline-block');
	}
	
});
