
$(document).ready(function() {
    $('#map_canvas').mapit();
});

jQuery(document).ready(function($) {
	var link_bg = $('#cover-show').attr('url-background');	
	$('.img-box').css({
		'background': 'url('+link_bg+') no-repeat center center',
		'background-size': 'cover'
	});
});

$(".center").slick({
	dots: true,
	infinite: true,
	slidesToShow: 3,
	slidesToScroll: 3
});

$(document).ready(function($) {
	$('.expandable').click(function () {
		$('.expandable').hide();
		$('.expandable-more').show(200);
	});

    var desc_height = $('.description-co').outerHeight();

    if(desc_height >= 126) {
        more($('.description-co'), $('#s-desc'));
        more($('.host-co'), $('#s-host'));
    } else {
        revmore($('.description-co .bottom-fill'), $('#s-desc'));
        revmore($('.host-co .bottom-fill'), $('#s-host'));
    }

    $('.description-co, #s-desc').click(function() {
        Eventmore($('.description-co'), $('.description-co .bottom-fill'), $('#s-desc'));
    });

	$('.rules-co, #s-rules').click(function() {
        Eventmore($('.rules-co'), $('.rules-co .bottom-fill'), $('#s-rules'));
	});

	$('.host-co, #s-host').click(function() {
        Eventmore($('.host-co'), $('.host-co .bottom-fill'), $('#s-host'));
	});

	$('#view-rules').click(function() {
		$('html, body').animate({
			scrollTop: $('#rules').offset().top - 55
		}, 1000);
		return false;
	});
});

function more(Elem_height, button_displ) {
    Elem_height.append('<div class="bottom-fill"></div>');
    button_displ.show();
}

function revmore(Elem_height, button_displ) {
    Elem_height.remove();
    button_displ.hide();
}

function Eventmore(parent_div, bottom_fill, button_more) {
    parent_div.css({
        'height': 'auto',
        'max-height': 'none'
    });
    bottom_fill.css({
        'opacity': '0'
    });
    button_more.hide();
}

$(document).ready(function() {
    $('.comment-box').each(function(index, el) {
        var elem = el['id'];
        var gElem = $('#'+elem+' .comment-content');
        var gmore = $('#'+elem+' #'+elem+'-more');
        var bFill = $('#'+elem+' .bottom-fill');
        var heightEl = gElem.outerHeight();
        if(heightEl >= 126) {
            gElem.append('<div class="bottom-fill"></div>');
            gmore.show();
        } else {
            revmore(bFill, gmore);
        }

        $('#'+elem).click(function () {
            $('#'+elem+' .bottom-fill').remove();
            Eventmore(gElem, bFill, gmore);
        });
    });
});

$(document).ready(function () {
	$(window).scroll(function(){
        var window_top = $(window).scrollTop() + 0; // the "12" should equal the margin-top value for nav.stick
        var div_top = $('#nav-anchor').offset().top;
        if (window_top > div_top) {
            $('.flatpickr-wrapper').css({
                'top': window_top + 126
            })
            $('.subnav').addClass('fixed');
            $(".booking-form").css({
                'position': 'fixed',
                'top': '40px'
            });
            $('.booking-header').addClass('fixed');
        } else {
            $('.subnav').removeClass('fixed');
            $(".booking-form").removeClass('fixed');
            $('.booking-header').removeClass('fixed');
            $(".booking-form").css({
                'position': 'absolute',
                'top': '0'
            });
        }
    });
    
    $(document).on("scroll", onScroll);
    
    $('a.subnav-item[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.subnav-list a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.subnav-list ul li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}

$(document).ready(function() {	
    $(window).scroll(function(){
	    var top = $('#booking').offset().top - parseFloat($('#booking').css('marginTop').replace(/auto/, 0));
	    var footTop = $('#host').offset().top - parseFloat($('#host').css('marginTop').replace(/auto/, 0));

	    var maxY = footTop - ($('#booking').outerHeight() + 95);

        var y = $(this).scrollTop();

        if (y > top) {
            if (y < maxY) {
                $('.booking-form').addClass('fixed').removeAttr('style');
                $('.booking-header').removeClass('fixed');
            } else {
                $('.booking-form').removeClass('fixed').css({
                    position: 'absolute',
                    top: (maxY - top) + 'px'
                });
                $('.flatpickr-wrapper').css({
                    top: (maxY - top)
                })
                $('.booking-header').addClass('fixed');
            }
        } else {
            $('.booking-form').removeClass('fixed');
        }

    });
});


