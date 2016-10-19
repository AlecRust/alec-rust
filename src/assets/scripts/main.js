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

  // Fix for the iOS viewport scaling bug: https://gist.github.com/901295
  (function(doc) {
    var addEvent = 'addEventListener',
      type = 'gesturestart',
      qsa = 'querySelectorAll',
      scales = [1, 1],
      meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
    function fix() {
      meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
      doc.removeEventListener(type, fix, true);
    }
    if ((meta = meta[meta.length - 1]) && addEvent in doc) {
      fix();
      scales = [0.25, 1.6];
      doc[addEvent](type, fix, true);
    }
  }(document));

}(jQuery));
