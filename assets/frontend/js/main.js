(function($) {
    "use strict";

    /*****************************
     * Commons Variables
     *****************************/
    var $window = $(window),
        $body = $('body');

    /****************************
     * Sticky Menu
     *****************************/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
        }
    });

    /**************************
     * Offcanvas: Menu Content
     **************************/
    function mobileOffCanvasMenu() {
        var $offCanvasNav = $('.offcanvas-menu'),
            $offCanvasNavSubMenu = $offCanvasNav.find('.mobile-sub-menu');

        /*Add Toggle Button With Off Canvas Sub Menu*/
        $offCanvasNavSubMenu.parent().prepend('<div class="offcanvas-menu-expand"></div>');

        /*Category Sub Menu Toggle*/
        $offCanvasNav.on('click', 'li a, .offcanvas-menu-expand', function(e) {
            var $this = $(this);
            if ($this.attr('href') === '#' || $this.hasClass('offcanvas-menu-expand')) {
                e.preventDefault();
                if ($this.siblings('ul:visible').length) {
                    $this.parent('li').removeClass('active');
                    $this.siblings('ul').slideUp();
                    $this.parent('li').find('li').removeClass('active');
                    $this.parent('li').find('ul:visible').slideUp();
                } else {
                    $this.parent('li').addClass('active');
                    $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
                    $this.closest('li').siblings('li').find('ul:visible').slideUp();
                    $this.siblings('ul').slideDown();
                }
            }
        });
    }
    mobileOffCanvasMenu();



    /****************************************
     *   Service Slider 
     *****************************************/
    var service_slider = new Swiper('.service-slider .swiper-container', {
        spaceBetween: 50,
        speed: 2500,
        loop: true,
        autoplay: true,
        // Navigation arrows
        navigation: {
            nextEl: '.service-slider .button-next',
            prevEl: '.service-slider .button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            768: {
                autoplay: false
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
                autoplay: false
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
                autoplay: false
                
            },
            1400: {
                slidesPerView: 3,
                spaceBetween: 50,
                autoplay: false
            },
            
        }
    });

    
    /****************************************
     *   Company Logo 
     *****************************************/
    var company_logo_slider = new Swiper('.company-logo-slider .swiper-container', {
        slidesPerView: 5,
        speed: 1500,
        loop: true,
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
            1600: {
                slidesPerView: 5,
            }
            
        }
    });

    /****************************************
     *   Testimonial  
     *****************************************/
     var testimonial_thumb  = new Swiper(".testimonial-thumb-slider .swiper-container", {
        slidesPerView: 3,
        speed: 2500,
        loop: true,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        autoplay: true,
        breakpoints: {

            0: {
                slidesPerView: 1,
            },

            768: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 3,
                centeredSlides: true,
            }
            
        }
      });
     var testimonial_content= new Swiper(".testimonial-content-slider .swiper-container", {
        loop: true,
        speed: 2500,
        autoplay: true,
        slidesPerView: 1,
        thumbs: {
          swiper: testimonial_thumb,
        },
      });

 

    /****************************************
     *   Blog Feed - Style 1
     *****************************************/
    var blog_feed_slider_1 = new Swiper('.blog-feed-slider-style-1 .swiper-container', {
        slidesPerView: 2,
        spaceBetween: 60,
        speed: 2500,
        loop: true,
        autoplay: true,
        // Navigation arrows
        navigation: {
            nextEl: '.button-next',
            prevEl: '.button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
                autoplay: false,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
                autoplay: false,
            },
            1200: {
                slidesPerView: 3,
                autoplay: false,
            },
            
        }
    });
    /****************************************
     *   Blog Feed - Style 2
     *****************************************/
    var blog_feed_slider_2 = new Swiper('.blog-feed-slider-style-2 .swiper-container', {
        slidesPerView: 2,
        spaceBetween: 40,
        speed: 2500,
        loop: true,
        // Navigation arrows
        navigation: {
            nextEl: '.button-next',
            prevEl: '.button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 2,
            },
            
        }
    });

    /****************************************
    *   Team Slider 
    *****************************************/
    var team_slider = new Swiper('.team-slider .swiper-container', {
        spaceBetween: 50,
        speed: 2500,
        loop: true,
        autoplay: true,
        // Navigation arrows
        navigation: {
            nextEl: '.team-slider .button-next',
            prevEl: '.team-slider .button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            768: {
                autoplay: false,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
                autoplay: false
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
                autoplay: false
                
            },
            1400: {
                slidesPerView: 3,
                spaceBetween: 50,
                autoplay: false
            },
            
        }
    });

    
    /****************************************
     *   Projects Slider - Gallery
     *****************************************/
        var projects_thumb  = new Swiper(".project-thumb-slider .swiper-container", {
            slidesPerView: 3,
            spaceBetween: 30,
            speed: 1500,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
          });
         var projects_large_image = new Swiper(".project-large-slider .swiper-container", {
            speed: 1500,
            spaceBetween: 30,
            slidesPerView: 1,
            thumbs: {
              swiper: projects_thumb,
            },
          });


    /****************************************
    *   Project Slider 
    *****************************************/
         var project_slider = new Swiper('.project-slider .swiper-container', {
            spaceBetween: 30,
            speed: 2500,
            loop: true,
            autoplay: true,
            // Navigation arrows
            navigation: {
                nextEl: '.project-slider .button-next',
                prevEl: '.project-slider .button-prev',
            },
            breakpoints: {
    
                0: {
                    slidesPerView: 1,
                },
                768: {
                    autoplay: false
                },
                992: {
                    slidesPerView: 2,
                    autoplay: false
                },
                1200: {
                    slidesPerView: 3,
                    autoplay: false
                },
                
            }
        });

    /************************************************
     * Project Filter
     ***********************************************/
         $('.project-items').imagesLoaded( function() {
            // filter items on button click
             $('.projects-gallery-filter-nav').on( 'click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });
                 
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
             });
    
            //  init Isotope
            var $grid = $('.project-items').isotope({
                itemSelector: '.filter-item',
                layoutMode: 'fitRows',
             });
         });


    /************************************************
     * Counter Up
     ***********************************************/
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    /************************************************
     * Scroll Top
     ***********************************************/
    $('body').materialScrollTop();
    

})(jQuery);
