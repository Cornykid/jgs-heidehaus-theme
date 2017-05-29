(function ($) {
    var JGSAccordion = {
        init: function($context){
            $context.find('.jgs-accordion__toggle').click(this.onClickToggle.bind(this));
            return this;
        },

        onClickToggle: function(event) {
            event.preventDefault();

            var $target = $(event.currentTarget);
            var contentId = $target.attr('aria-controls');
            var nextStateExpanded = !JSON.parse($target.attr('aria-expanded'));

            $('#' + contentId).slideToggle(function onSlideToggleComplete() {
                var $toggleLinks = $('[aria-controls=' + contentId + ']');
                var $content = $('#' + contentId);

                $toggleLinks.attr('aria-expanded', nextStateExpanded);

                $content.attr('aria-hidden', !nextStateExpanded);

                if (nextStateExpanded) {
                    $content.attr('tabIndex', -1);
                    $content[0].focus();
                } else {
                    $toggleLinks.eq(0)[0].focus();
                }
            });
        }
    };

    function initJGSAccordions() {
        Object.create(JGSAccordion).init($(this));
    }

    $(document).ready(function () {
        $(".jgs-accordion").each(initJGSAccordions);
    });
})(jQuery);