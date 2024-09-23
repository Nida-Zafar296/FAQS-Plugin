jQuery(document).ready(function($) {
    $('.faq-question').on('click', function() {
        var $this = $(this);
        var $answer = $this.next('.faq-answer');

        // Toggle visibility of the answer
        $answer.slideToggle();

        // Toggle the plus/minus sign
        var $toggle = $this.find('.faq-toggle');
        if ($toggle.text() === '+') {
            $toggle.text('-');
        } else {
            $toggle.text('+');
        }
    });
});
