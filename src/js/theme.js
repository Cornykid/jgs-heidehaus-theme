(function ($) {
    'use strict';

    $(document).ready(function () {

        // Replace SVG images with inline SVG
        $('img[src$=".svg"]').each(function() {
            var $img = $(this);
            var imgURL = $img.attr('src');
            var attributes = $img.prop("attributes");

            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');

                $svg = $svg.removeAttr('xmlns:a');

                $.each(attributes, function() {
                    $svg.attr(this.name, this.value);
                });

                $img.replaceWith($svg);
            }, 'xml');
        });

        // Change Arrow Color
        //$('img[src$=".svg"]').each(function() {
        //	$('cls-1').css('stroke',$('cls-1').closest('article[class*="teaser-theme-"]').css("background-color"));
        //});

        // Offcanvas
        $('[data-toggle="offcanvas"], .overlay').click(function () {
            $('.row-offcanvas').toggleClass('active');
        });

        // Slider
        $('.header-slider').slick({
            autoplay : true,
            autoplaySpeed: 6000,
            infinite: true,
            dots: true,
            fade: true,
            prevArrow: false,
            nextArrow: false,
        });

        // Cites
        $('.cites-slider').slick({
            autoplay: true,
            infinite: true,
            dots: false
        });


        // Affix
        /*$('#main-menu-desktop').affix({
         offset: {
         top: function () {
         return $('.header-slider').outerHeight(true);
         }
         }
         });*/
    });
})(jQuery);