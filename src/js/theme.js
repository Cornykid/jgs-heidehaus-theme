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


        // Slider
        $('.header-slider').slick({
            autoplay : true,
            autoplaySpeed: 6000,
            infinite: true,
            dots: true,
            fade: true
        });

    });
})(jQuery);