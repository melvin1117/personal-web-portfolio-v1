/*
Theme Name: IAMX
Author: Trendy Theme
Author URL: trendytheme.net
*/

/*
    = Preloader
    = Animated scrolling / Scroll Up
    = Full Screen Slider
    = Sticky Menu
    = Back To Top
    = Countup
    = Progress Bar
    = More skill
    = Shuffle
    = Magnific Popup
    = Vidio auto play
    = Fit Vids
    = Google Map

*/

jQuery(function ($) {

    'use strict';

    /* ---------------------------------------------- /*
     * Preloader
    /* ---------------------------------------------- */

    $(window).ready(function() {
        $('#pre-status').fadeOut();
        $('#tt-preloader').delay(350).fadeOut('slow');
    });



    // ----------------------------------------------
    // Owl Carousel
    // ----------------------------------------------
    (function () {

        $(".st-quotes").owlCarousel({
        singleItem:true,
        lazyLoad : true,
        pagination:false,
        navigation : false,
        autoPlay: true,
        });

    }());


    // -------------------------------------------------------------
    // Animated scrolling / Scroll Up
    // -------------------------------------------------------------

    (function () {
        $('a[href*=#]').bind("click", function(e){
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top
            }, 1000);
            e.preventDefault();
        });
    }());



    // -------------------------------------------------------------
    // Full Screen Slider
    // -------------------------------------------------------------
    (function () {
        $(".tt-fullHeight").height($(window).height());

        $(window).resize(function(){
            $(".tt-fullHeight").height($(window).height());
        });

    }());


    // -------------------------------------------------------------
    // Sticky Menu
    // -------------------------------------------------------------

    (function () {
        $('.header').sticky({
            topSpacing: 0
        });

        $('body').scrollspy({
            target: '.navbar-custom',
            offset: 70
        })
    }());




    // -------------------------------------------------------------
    // Back To Top
    // -------------------------------------------------------------

    (function () {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scroll-up').fadeIn();
            } else {
                $('.scroll-up').fadeOut();
            }
        });
    }());


    // -------------------------------------------------------------
    // Countup
    // -------------------------------------------------------------
    $('.count-wrap').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.timer').each(function () {
                var $this = $(this);
                $({ Counter: 0 }).animate({ Counter: $this.text() }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).unbind('inview');
        }
    });


    // -------------------------------------------------------------
    // Progress Bar
    // -------------------------------------------------------------
 
    $('.skill-progress').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $.each($('div.progress-bar'),function(){
                $(this).css('width', $(this).attr('aria-valuenow')+'%');
            });
            $(this).unbind('inview');
        }
    });
    
    // -------------------------------------------------------------
    // More skill
    // -------------------------------------------------------------
    $('.more-skill').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $('.chart').easyPieChart({
                //your configuration goes here
                easing: 'easeOut',
                delay: 3000,
                barColor:'#68c3a3',
                trackColor:'rgba(255,255,255,0.2)',
                scaleColor: false,
                lineWidth: 8,
                size: 140,
                animate: 2000,
                // onStep: function(from, to, percent) {
                    
                // }

            });
            $(this).unbind('inview');
        }
    });


    // -------------------------------------------------------------
    // Shuffle
    // -------------------------------------------------------------

    (function () {

        var $grid = $('#grid');

        $grid.shuffle({
            itemSelector: '.project-item'
        });

        /* reshuffle when user clicks a filter item */
        $('#filter a').click(function (e) {
            e.preventDefault();

            // set active class
            $('#filter a').removeClass('active');
            $(this).addClass('active');

            // get group name from clicked item
            var groupName = $(this).attr('data-group');

            // reshuffle grid
            $grid.shuffle('shuffle', groupName );
        });


    }());


    // // -------------------------------------------------------------
    // // Magnific Popup
    // // -------------------------------------------------------------

    // (function () {
    //   $('.image-link').magnificPopup({

    //     gallery: {
    //       enabled: true
    //     },
    //     removalDelay: 300, // Delay in milliseconds before popup is removed
    //     mainClass: 'mfp-with-zoom', // this class is for CSS animation below
    //     type:'image'
    //   });

    // }());



    // (function () {
    //     $('.popup-video').magnificPopup({
    //         disableOn: 700,
    //         type: 'iframe',
    //         mainClass: 'mfp-with-zoom',
    //         removalDelay: 300,
    //         preloader: false,
    //         fixedContentPos: false
    //     });
    // }());





    // // -------------------------------------------------------------
    // // Fit Vids
    // // -------------------------------------------------------------
    // (function () {
    //     $(".video-container").fitVids();
    // }());



    // // -------------------------------------------------------------
    // // Vidio auto play
    // // -------------------------------------------------------------
    // (function () {
    
    // /* Vimeo API: http://developer.vimeo.com/player/js-api */
    
    //     var iframe = document.getElementById('nofocusvideo');
    //     // $f == Froogaloop
    //     var player = $f(iframe);

    //     $('.modal').on('hidden.bs.modal', function () {
    //     player.api('pause');
    //     })

    //     $('.modal').on('shown.bs.modal', function () {
    //     player.api('play');
    //     })
    // }());




    // -------------------------------------------------------------
    // STELLAR FOR BACKGROUND SCROLLING
    // -------------------------------------------------------------

    $(window).load(function() {

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
         
        }else {
            $.stellar({
                horizontalScrolling: false,
                responsive: true
            });
        }

    });


    // -------------------------------------------------------------
    // WOW JS
    // -------------------------------------------------------------

    (function () {

        new WOW({

            mobile:  false

        }).init();

    }());



    // -------------------------------------------------------------
    // Contact Form
    // -------------------------------------------------------------

    $('#contactForm').on('submit',function(e){

        e.preventDefault();

        var $action = $(this).prop('action');
        var $data = $(this).serialize();
        var $this = $(this);

        $this.prevAll('.alert').remove();

        $.post( $action, $data, function( data ) {

            if( data.response=='error' ){

                $this.before( '<div class="alert alert-danger">'+data.message+'</div>' );
            }

            if( data.response=='success' ){
                 console.log("yess");
                $this.before( '<div class="alert alert-success">'+data.message+'</div>' );
                $this.find('input, textarea').val('');
            }
              console.log(data.response);

        }, "json");

    });



    // -------------------------------------------------------------
    // Download Form
    // -------------------------------------------------------------

    $('#downloadForm').on('submit',function(e){

        e.preventDefault();

        var $action = $(this).prop('action');
        var $data = $(this).serialize();
        var $this = $(this);

        $this.prevAll('.alert').remove();

        $.post( $action, $data, function( data ) {

            if( data.response=='error' ){
                   document.getElementById("overlay_gif").style.display = "none";
                $this.before( '<div class="alert alert-danger">'+data.message+'</div>' );
                
            }

            if( data.response=='success' ){
                console.log("yesd");
                 document.getElementById("overlay_gif").style.display = "none";
                $this.before( '<div class="alert alert-success">'+data.message+'</div>' );
                 $this.find('input, textarea').val('');
                 window.open('assets/pdf/smf_cv.pdf','_blank');

                
            }
            console.log(data.response);

        }, "json");

    });




    // -------------------------------------------------------------
    // Google Map
    // -------------------------------------------------------------

    (function () {
        var myLatlng = new google.maps.LatLng(12.847447, 80.202100);

            var styles = [
                {
                    featureType: "landscape",
                    stylers: [
                        { color: '#f7f7f7' }
                    ]
                },{
                    featureType: "natural",
                    stylers: [
                        { hue: '#00ffe6' }
                    ]
                },{
                    featureType: "road",
                    stylers: [
                        { hue: '#fff' },
                        { saturation: -70 }
                    ]
                },{
                    featureType: "building",
                    elementType: "labels",
                    stylers: [
                        { hue: '' }
                    ]
                },{
                    featureType: "poi", //points of interest
                    stylers: [
                        { hue: '' }
                    ]
                }
            ];

            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                styles: styles
            }
            var map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                animation: google.maps.Animation.DROP,
                title: 'Hello I am here!'
            });

            var contentString = 'You can get me here.!';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });

    }());


});





