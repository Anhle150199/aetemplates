(function ($)
  { "use strict"

/* 1. Proloder */
    $(window).on('load', function () {
      $('#preloader-active').delay(450).fadeOut('slow');
      $('body').delay(450).css({
        'overflow': 'visible'
      });
    });

/* 2. slick Nav */
// mobile_menu
    var menu = $('ul#navigation');
    if(menu.length){
      menu.slicknav({
        prependTo: ".mobile_menu",
        closedSymbol: '+',
        openedSymbol:'-'
      });
    };

    // Weekly-2 Acticve
      $('.weekly2-news-active').slick({
          dots:false,
          infinite: true,
          speed: 500,
          arrows: true,
          autoplay:true,
          loop:true,
          slidesToShow: 3,
          prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-angle-double-left"></i></button>',
          nextArrow:'<button type="button" class="slick-next"><i class="fas fa-angle-double-right"></i></button>',
          slidesToScroll: 1,
          responsive: [
            {
            breakpoint: 1200,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
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
            breakpoint: 700,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
            }
            },
            {
            breakpoint: 480,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
            }
            }
          ]
          });


    // Weekly-2 Acticve
      $('.weekly3-news-active').slick({
          dots:true,
          infinite: true,
          speed: 500,
          arrows: false,
          autoplay:true,
          loop:true,
          slidesToShow: 4,
          prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-angle-double-left"></i></button>',
          nextArrow:'<button type="button" class="slick-next"><i class="fas fa-angle-double-right"></i></button>',
          slidesToScroll: 1,
          responsive: [
            {
            breakpoint: 1200,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
              dots: true,
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
            breakpoint: 700,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
            }
            },
            {
            breakpoint: 480,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
            }
            }
          ]
    });

    // recent-active
    $('.recent-active').slick({
        dots: false,
        infinite: true,
        speed: 600,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick-prev"> <span class="flaticon-arrow"></span></button>',
        nextArrow: '<button type="button" class="slick-next"> <span class="flaticon-arrow"><span></button>',

        initialSlide: 3,
        loop:true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: false,
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
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    });

/* 6. Nice Selectorp  */
  var nice_Select = $('select');
    if(nice_Select.length){
      nice_Select.niceSelect();
    }

/* 7.  Custom Sticky Menu  */
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 245) {
        $(".header-sticky ").removeClass("sticky-bar");
      } else {
        $(".header-sticky").addClass("sticky-bar");
      }
    });

    /*   Show img flex  */
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 245) {
        $(".header-flex").removeClass("sticky-flex");
      } else {
        $(".header-flex").addClass("sticky-flex");
      }
    });

    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 245) {
          $(".header-sticky").removeClass("sticky");
      } else {
          $(".header-sticky").addClass("sticky");
      }
    });

/* 8. sildeBar scroll */
    $.scrollUp({
      scrollName: 'scrollUp', // Element ID
      topDistance: '300', // Distance from top before showing element (px)
      topSpeed: 300, // Speed back to top (ms)
      animation: 'fade', // Fade, slide, none
      animationInSpeed: 200, // Animation in speed (ms)
      animationOutSpeed: 200, // Animation out speed (ms)
      scrollText: '<i class="fas fa-arrow-up"></i>', // Text for element
      activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });
// Add class

  $('.sticky-logo').addClass('info-open');
// Remove clas
  $('.close-icon').click(function(){
    $('.extra-inofo-bar').removeClass('info-open');
  })

})(jQuery);
