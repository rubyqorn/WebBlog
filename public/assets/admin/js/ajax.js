$(document).ready(function() {

    // Show articles categories with AJAX
    $('#categories-table #categories-item a.articles').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/articles-categories', 'GET', '#categories-table .row');
    });

    // Show news categories with AJAX
    $('#categories-table #categories-item a.news').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/news-categories', 'GET', '#categories-table .row');
    });

    // Show discussions categories with AJAX
    $('#categories-table #categories-item a.discussions').click(function(event) {
        event.preventDefault();

        ajaxHandler('/admin/discussions-categories', 'GET', '#categories-table .row');
    });

    // Show spinner before content will display
    function before()
    {
        $('#categories-table').html('<div class="spinner-grow" role="status"> <span></span> </div>');
    }

    // AJAX processing
    function ajaxHandler(url, type, section) 
    {
        $.ajax({
            url,
            type,
            beforeSend: before(),
        }).done(function(data) {
            $(section).html(data);
        });
    }

});

