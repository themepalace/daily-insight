jQuery(document).ready(function($){

/*------------------------------------------------
                BODY
------------------------------------------------*/
$('body').css({"display":"block"});

/*------------------------------------------------
                SIDR MENU
------------------------------------------------*/

$('#sidr-left-top-button').sidr({
    name: 'sidr-left-top',
    timing: 'ease-in-out',
    speed: 500,
    side: 'left',
    source: '.left'
});

/*------------------------------------------------
                END SIDR MENU
------------------------------------------------*/

/*------------------------------------------------
                MENU ACTIVE
------------------------------------------------*/

$('.main-navigation ul li').click(function() {
    $('.main-navigation ul li').removeClass('current-menu-item');
    $(this).addClass('current-menu-item');
});
$(".menu-item-has-children").hover(function() {

});

/*------------------------------------------------
                END MENU ACTIVE
------------------------------------------------*/

/*------------------------------------------------
                SLICK SLIDER
------------------------------------------------*/
var $slider_effect = $('#main-slider').data('effect');
var $slider_effect1 = $('#featured-gallery-slider .regular').data('effect');

$('#main-slider').slick({
    cssEase : $slider_effect
});

$("#breaking-news .regular").slick({

});


$("#featured-gallery-slider .regular").slick({
    cssEase : $slider_effect1,
    customPaging : function(slider, i) {
        var thumb = $(slider.$slides[i]).data('thumb');
        return '<a><img src="'+thumb+'"></a>';
    }
});
$("#trending-news-slider .regular").slick({
    responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$(".widget_post_slider .regular").slick({

});
$(".widget_post_slider button.slick-prev").insertAfter('.widget_post_slider .widget-wrap');
$(".widget_post_slider button.slick-next").insertAfter('.widget_post_slider button.slick-prev');

/*------------------------------------------------
                END SLICK SLIDER
------------------------------------------------*/

/*------------------------------------------------
                TABS
------------------------------------------------*/
$('ul.tabs li').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('active');
    $('.tab-content').removeClass('active');

    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
});


/*------------------------------------------------
                PRETTYPHOTO
------------------------------------------------*/

if ($().prettyPhoto) {
    $("a[data-gal^='prettyPhoto']").prettyPhoto({
        theme: 'light_square'
    });
}

/*------------------------------------------------
                END PRETTYPHOTO
------------------------------------------------*/

/*------------------------------------------------
                SOCIAL ICON JETPACK
------------------------------------------------*/

$('.sharedaddy .sd-content ul').addClass('social-icons');


});

/*------------------------------------------------
            END JQUERY
------------------------------------------------*/



