// GitHub Activity
(function ($) {
    $.fn.ghActivity = function (opt) {
        var def = {
            FeedUrl: 'https://github.com/AlecRust.atom',
            ItemCount: 3,
            ShowDesc: false
        };
        if (opt) {
            $.extend(def, opt);
        }
        var targetElement = $(this).attr('id');
        if (def.FeedUrl == null || def.FeedUrl == '') {
            $('#' + targetElement).empty();
            return;
        }
        var publishDate;
        $('#' + targetElement).addClass('loading');
        $.ajax({
            url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=' + def.ItemCount + '&output=json&q=' + encodeURIComponent(def.FeedUrl) + '&callback=?',
            dataType: "json",
            success: function (data) {
                $('#' + targetElement).removeClass('loading');
                $.each(data.responseData.feed.entries, function (i, entry) {
                    publishDate = new Date(entry.publishedDate);
                    $('#' + targetElement).append('<li><a href="' + entry.link + '">' + entry.title + '</a> <span class="timestamp">' + publishDate.toLocaleDateString() + '</span></li>');
                    if (def.ShowDesc) {
                        $('#' + targetElement).append('<div class="description">' + entry.content + '</div>');
                    }
                });
            }
        });
    };
})(jQuery);
