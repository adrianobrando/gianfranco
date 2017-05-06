// Global vars
var n2mu_sticky_header        =  n2muJSParams.sticky_header;
var header_mobile_point       =  n2muJSParams.header_mobile_point;
var n2mu_one_page             =  n2muJSParams.one_page_mode;


jQuery(document).ready(function($) {
"use strict";


/* Slide menu */
$(".menu-holder").click(function(){
  $(".menu-holder").toggleClass("active");
  $(".n-header-desktop .n-main-menu-wrapper").toggle("slide");
  $(".n-header-mobile .n-mobile-menu-wrap").toggle("slide");
});

/* Sticky header */
if(n2mu_sticky_header == '1') {
  var nHeaderHeight = $('.n-header-desktop').outerHeight();
  var nStickyHeader = function(){
    if($(window).width() >= header_mobile_point) {
      if ($(window).scrollTop() > 0) {
        var nAdminBar = $('#wpadminbar').outerHeight();
        $('.n-header-desktop').addClass('n-header-sticky');
        $('body').css('margin-top', nHeaderHeight);
        $('.n-header-desktop.n-header-sticky').css('top', nAdminBar);
      } else {
        $('.n-header-desktop').removeClass('n-header-sticky');
        $('body').css('margin-top', '0');
      }
    }
  };

  $(window).bind( 'resize scroll', nStickyHeader );
  nStickyHeader();
}

/******** Go to top function *********/
var offset = 220;
var duration = 550;
$(window).scroll(function() {
  if ($(this).scrollTop() > offset) {
    $('.gotoplink').fadeIn(duration);
  } else {
    $('.gotoplink').fadeOut(duration);
  }
});

$('.gotoplink').click(function(event) {
  event.preventDefault();
  $('html, body').animate({scrollTop: 0}, duration);
  return false;
});



/******** Initialize isotope on portfolio-listing page *********/
var $container = $('#isotope-list'); //The ID for the list with all the blog posts

$(window).load(function() {
  $container.isotope({ //Isotope options, 'item' matches the class in the PHP
    itemSelector : '.portfolio-item',
    percentPosition: true, 
      layoutMode : 'fitRows'
  });
});

  //Add the class selected to the item that is clicked, and remove from the others
  var $optionSets = $('#filters'),
  $optionLinks = $optionSets.find('a');

  $optionLinks.click(function(){
  var $this = $(this);
  // don't proceed if already selected
  if ( $this.hasClass('selected') ) {
    return false;
  }
  var $optionSet = $this.parents('#filters');
  $optionSets.find('.selected').removeClass('selected');
  $this.addClass('selected');

  //When an item is clicked, sort the items.
   var selector = $(this).attr('data-filter');
  $container.isotope({ filter: selector });

  return false;
});


/******** Initialize isotope on blog listing page *********/
var $containerSimpleBlog = $('.blog-listing-simple-3col-listing'); //The ID for the list with all the blog posts

$(window).load(function() {
  $containerSimpleBlog.isotope({ //Isotope options, 'item' matches the class in the PHP
    itemSelector : '.post-item',
    percentPosition: true, 
      layoutMode : 'masonry'
  });
});

var $containerCardBlog = $('.blog-listing-card-3col-listing'); //The ID for the list with all the blog posts

$(window).load(function() {
  $containerCardBlog.isotope({ //Isotope options, 'item' matches the class in the PHP
    itemSelector : '.post-item',
    percentPosition: true, 
      layoutMode : 'masonry'
  });
});



/******** Initialize owl carousel for related portfolio *********/
$("#portfolio_carousel").owlCarousel({
    items: 				3,
    responsive : {
						0 : {
							items: 		1,
						},
						480 : {
							items: 		1,
						},
						768 : {
							items: 		2,
						},
						1000 : {
							items: 		3,
						}
					},
    nav: 		true,
    autoHeight: 		false,
    navText:			["<span class=\'owl-nav-button fa fa-angle-left\'></span>","<span class=\'owl-nav-button fa fa-angle-right\'></span>"],
    slideBy: 			1,
    loop:   true,
    margin:30,
});



/******** Popup image effect *********/
$('.image-popup-link').magnificPopup({
  type:'image',
  removalDelay: 300,
  mainClass: 'mfp-with-zoom',
  overflowY: 'auto',
  fixedContentPos: false,
  fixedBgPos: false,

   zoom: {
    enabled: true,
    duration: 300, // duration of the effect, in milliseconds
    easing: 'ease-in-out',
   }
});

$('.woocommerce-product-gallery__wrapper a').magnificPopup({
  type:'image',
  removalDelay: 300,
  mainClass: 'mfp-with-zoom',
  overflowY: 'auto',
  fixedContentPos: false,
  fixedBgPos: false,
gallery:{
    enabled:true
  },
   zoom: {
    enabled: true,
    duration: 300, // duration of the effect, in milliseconds
    easing: 'ease-in-out',
   }
});


/******** Menu init *********/
var menu = $( 'header .n-menu-wrap' );

var defaults = {
  addLast   : false,
  arrows      : true,
  delay       : 200,
  hoverClass  : 'hover',
  mobileInit  : header_mobile_point
};

  // append mobile toggle button
  $( 'li:has(ul)', menu ).append( '<span class="menu-toggle"></span>' );
  
  // appand submenu arrows
  if( defaults.arrows ) {
    $( 'li ul li:has(ul) > a', menu ).append( '<i class="menu-arrow fa fa-angle-right"></i>' );
  }

var initMenu = function(){

  if( $(window).width() >= defaults.mobileInit ){
    
    // desktop --------------------------------

    $( '> ul > li, ul li:not(.megamenu) ul li', menu ).hover(function() {
      if(!$(this).hasClass( defaults.hoverClass )) {
        $(this).stop(true,true).addClass( defaults.hoverClass );
          $(this).children( 'ul' ).stop(true).slideDown( defaults.delay );
      }
    }, function(){
      $(this).stop(true,true).removeClass( defaults.hoverClass );
      if($(this).css('display') != 'none') {
        $(this).children( 'ul' ).stop(true).slideUp( defaults.delay ); 
      }
    });
    
  } else {
    // mobile 
    $( 'li', menu ).unbind('hover');
    $( 'li > .menu-toggle', menu ).off('click').on('click', function(){
      var el = $(this).closest('li');
      if( el.hasClass( defaults.hoverClass ) ){
        el.removeClass( defaults.hoverClass ).children('ul').stop(true,true).slideToggle( defaults.delay );
      } else {
        el.addClass( defaults.hoverClass ).children('ul').stop(true,true).slideToggle( defaults.delay );  
      }
    });
  }
};

$(window).bind( 'resize', initMenu );
initMenu();

/******** Add height to footer columns to add borders properly *********/
var initFooterColHeight = function(){
    if( $(window).width() >= 992 ) {
      var footerColHeight = $('.n2mu-footer-column').height();
      $('.n2mu-footer-column').each(function(){
        if( $(this).height() > footerColHeight) {
          footerColHeight = $(this).height();
        }
        return footerColHeight;
      });

      $('.n2mu-footer-column').each(function(){
        $(this).css('min-height', footerColHeight+'px');
      });
    } else {
      $('.n2mu-footer-column').css('min-height', '');
    }
}
initFooterColHeight();
$('.n2mu-footer-column').last().addClass('last');
$(window).bind( 'resize', initFooterColHeight );


/******** Search popup function *********/
$(".header-search-icon").click(function(event) {
    event.preventDefault();
    $('.n2mu-search-holder').addClass('opened');
});
$(".n2mu-search-close").click(function(event) {
    event.preventDefault();
    $('.n2mu-search-holder').removeClass('opened');
});


/******** One Page Function *********/
if(n2mu_one_page == '1') {
    $('a').on('click',function (e) {
      if (this.hash !== "") {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          e.preventDefault();

          var target = this.hash;
          var $target = $(target);

          if( $(window).width() >= header_mobile_point ){
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - $('.n-header-desktop.n-header-sticky').height() - $('#wpadminbar').height()
            }, 1200, 'easeInOutExpo');
          } else {
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - $('#wpadminbar').height()
            }, 1200, 'easeInOutExpo');
          }
        }
      }
	});
}

$.easing.jswing = $.easing.swing;

$.extend($.easing,
{
  easeInOutExpo: function (x, t, b, c, d) {
        if (t==0) return b;
        if (t==d) return b+c;
        if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
        return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
    },
});

}); // END: document.ready


/******* Prealoader function **********/
jQuery(window).load(function($){
  setTimeout(function(){
  jQuery('.n2mu-preloader').css("opacity","0");
  jQuery('.n2mu-preloader').css("visibility","hidden");
  }, 500);
});
