!function(n,t){t.fn.cycle=function(i,e){if(this.length){var a=i.length;return e=t.extend({delay:5e3,transitionDuration:300},e),this.each(function(){function o(t){s.animate({opacity:0},e.transitionDuration,e.transitionEasing,function(){s.text(i[t]).animate({opacity:1},e.transitionDuration,e.transitionEasing,function(){a!==t+1&&n.setTimeout(function(){o((t+1)%a)},e.delay)})})}var s=t(this);n.setTimeout(function(){o(0)},e.delay)})}return this}}(this,this.jQuery),function(n){function t(){for(var n=document.getElementsByTagName("a"),t=0;t<n.length;t++){var i=n[t];i.getAttribute("href")&&i.hostname!==location.hostname&&(i.target="_blank")}}n(window).scroll(function(){var t=n("body");t.addClass("scrolling");var i=n(window).scrollTop();i<=1&&t.removeClass("scrolling")}),n(".show-search a").click(function(){return n(".global-search").addClass("search-visible"),n(".global-search-input").focus(),!1}),n(document).keyup(function(t){27===t.keyCode&&n(".global-search").removeClass("search-visible")}),n(".show-navigation a").click(function(){return n(".global-navigation").addClass("navigation-visible"),!1}),t(),function(n){function t(){s.content="width=device-width,minimum-scale="+o[0]+",maximum-scale="+o[1],n.removeEventListener(e,t,!0)}var i="addEventListener",e="gesturestart",a="querySelectorAll",o=[1,1],s=a in n?n[a]("meta[name=viewport]"):[];(s=s[s.length-1])&&i in n&&(t(),o=[.25,1.6],n[i](e,t,!0))}(document)}(jQuery);