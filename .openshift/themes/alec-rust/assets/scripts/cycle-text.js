!function(t,n){n.fn.cycle=function(i,a){if(this.length){var e=i.length;return a=n.extend({delay:5e3,transitionDuration:300},a),this.each(function(){function o(n){u.animate({opacity:0},a.transitionDuration,a.transitionEasing,function(){u.text(i[n]).animate({opacity:1},a.transitionDuration,a.transitionEasing,function(){e!==n+1&&t.setTimeout(function(){o((n+1)%e)},a.delay)})})}var u=n(this);t.setTimeout(function(){o(0)},a.delay)})}return this}}(this,this.jQuery);