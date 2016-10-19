// Cycle text
(function (w, $) {
  $.fn.cycle = function (arr, o) {

    // Avoid acting on empty sets
    if (this.length) {

      // Cache the array length
      var aLen = arr.length;

      // Merge options with defaults
      o = $.extend({
        delay              : 5000,
        transitionDuration : 300
      }, o);

      // Return a jQuery object
      return this.each(function () {

        // Cache our jQuery object
        var $this = $(this);

        // Named function to avoid arguments.callee
        function switchText(idx) {

          // Turn down opacity all the way (so we don't get reflows like with fadeIn/Out)
          $this.animate({ opacity: 0 }, o.transitionDuration, o.transitionEasing, function () {

            // Replace the text and turn the opacity back up
            $this
            .text(arr[idx])
            .animate({ opacity: 1 }, o.transitionDuration, o.transitionEasing, function () {

              // Set a timeout from here, so we can avoid timing errors
              // Only run for length of array
              if (aLen !== (idx + 1)) {
                w.setTimeout(function () { switchText((idx + 1) % aLen); }, o.delay);
              }
            });
          });
        }

        // Start it off (use w, so it's locally scoped and jslint is happy)
        w.setTimeout(function () { switchText(0); }, o.delay);
      });
    }
    return this;
  };
})(this, this.jQuery);

(function ($) {

  // Add class to body when scrolling
  $(window).scroll(function() {
    var $body = $('body');
    $body.addClass('scrolling');
    var scroll = $(window).scrollTop();
    if (scroll <= 1) {
      $body.removeClass('scrolling');
    }
  });

  // Show search
  $('.show-search a').click(function(event) {
    event.preventDefault();
    $('.global-search').addClass('search-visible');
    $('.global-search-input').focus();
  });

  // Esc from search
  $(document).keyup(function(e) {
    if (e.keyCode === 27) { // Esc key
      $('.global-search').removeClass('search-visible');
    }
  });

  // Show navigation
  $('.show-navigation a').click(function(event) {
    event.preventDefault();
    $('.global-navigation').addClass('navigation-visible');
  });

  // Open external links in new tab
  function externalLinks() {
    for (var c = document.getElementsByTagName('a'), a = 0; a < c.length; a++) {
      var b = c[a];
      b.getAttribute('href') && b.hostname !== location.hostname && (b.target = '_blank');
    }
  }
  externalLinks();

}(jQuery));
