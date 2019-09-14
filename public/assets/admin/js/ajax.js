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
        $('#category-table').html('<div class="spinner-grow" role="status"> <span></span> </div>');
    }

    // AJAX processing
    function ajaxHandler(url, method, section) 
    {
        $.ajax({
            url: url,
            method: method,
            beforeSend: before(),
        }).done(function(data) {
            $(section).html(data);
        });
    }

});

function newFunction() {
    console.log(this);
}

