$(function() {

    $('.pagination_websites>a').on('click', function() {

        $('.gallery_loader').show();

        var link = $(this).attr('href');

        $.ajax({
            type: 'POST',
            url: link,

        }).success(function(result) {

            $('#gallery_websites').html(result);
            $('.websites_loader').hide();

        });

        return false;
    });

    $('.pagination_logos>a').on('click', function() {

        $('.gallery_loader').show();

        var link = $(this).attr('href');

        $.ajax({
            type: 'POST',
            url: link,

        }).success(function(result) {

            $('#gallery_logos').html(result);
            $('.logos_loader').hide();

        });

        return false;
    });

    // init gallery
    Gallery.init();

});

var Gallery = {

    init: function() {

        var gallery = this;
        $(".websites div img, .logos div img").fadeIn(500);

        $('.websites div div.details').hover(function() {

            $(this).css('display', 'block');
        });

        $('.websites div').hover(function() {

            gallery.showDetails(this);
        }, function() {

            gallery.hideDetails(this);
        });
        
    },

    showDetails: function(obj) {

        $(obj).children('.details').fadeIn();
    },

    hideDetails: function(obj) {
        
        $(obj).children('.details').fadeOut();
    }
};
