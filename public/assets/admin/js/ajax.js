$(document).ready(function() {

    // Show articles categories with AJAX
    $('#category a.articles').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/articles-categories', 'GET', '.container .row');
    });

    // Show news categories with AJAX
    $('#category a.news').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/news-categories', 'GET', '.container .row');
    });

    // Show discussions categories with AJAX
    $('#category a.discussions').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/discussions-categories', 'GET', '.container .row');
    });

    // Show and hide block in categories
    $('#category img').mouseenter(function() {

        const col = $(this).parent();
        const row = $(col).parent();
        const mainElem = $(row).parent();

        $(mainElem).find('#category-content').removeClass('d-none');

    }).mouseleave(function() {

        const col = $(this).parent();
        const row = $(col).parent();
        const mainElem = $(row).parent();

        $(mainElem).find('#category-content').addClass('d-none');
    });


    // Show spinner before content will display
    function before()
    {
        $('.container .row').html('<div class="spinner-grow" role="status"> <span></span> </div>');
    }

    // AJAX processing
    function ajaxHandler(url, type, section) 
    {
        $.ajax({
            url: url,
            type: type,
            beforeSend: before()
        }).done(function(data) {
            $(section).html(data);
        });
    }

});

