// Add class to body when scrolling
var $body = $('body');
$(window).scroll(function() {
    $body.addClass('scrolling');
    var scroll = $(window).scrollTop();
    if (scroll <= 1) {
        $body.removeClass('scrolling');
    }
});

// Show search
$('.show-search a').click(function() {
    $('.global-search').addClass('search-visible');
    return false;
});

// Show navigation
$('.show-navigation a').click(function() {
    $('.global-navigation').addClass('navigation-visible');
    return false;
});

// Open external links in new tab
$('a[href^=http]').click(function () {
    var a = new RegExp('/' + window.location.host + '/');
    if (!a.test(this.href)) {
        window.open(this.href);
        return false;
    }
});

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

// Hide address bar on mobile devices
(function (win) {
    if (!/mobile/i.test(navigator.userAgent)) return;
    var doc = win.document;
    if (!location.hash || !win.addEventListener) {
        window.scrollTo(0, 1);
        var scrollTop = 1,
            getScrollTop = function () {
                return "scrollTop" in doc.body ? doc.body.scrollTop : 1;
            },
            bodycheck = setInterval(function () {
                if (doc.body) {
                    clearInterval(bodycheck);
                    scrollTop = getScrollTop();
                    win.scrollTo(0, scrollTop === 1 ? 0 : 1);
                }
            }, 15);
        win.addEventListener("load", function () {
            setTimeout(function () {
                if (getScrollTop() < 20) {
                    win.scrollTo(0, scrollTop === 1 ? 0 : 1);
                }
            }, 0);
        }, false);
    }
})(this);
