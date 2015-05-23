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
