$(document).ready(function() {

    // I have to finish this searching when i will go for backend part of this app
    $('#search-form #search').keyup(function() {
        const content = $(this).val();

        $('#search-form #result .content a.text-black-50').html(content);
    })

    // Load categories by id from category.php
    $('#news #categories .nav-link').click(function(event) {
        event.preventDefault();
        setTimeout(function() {
            $('#news .col-lg-7 .posts').load('category.php');
        }, 1500);  
    });

    // Pagination for news page
    $('#news #pagination .page-item').click(function(event) {
        event.preventDefault();

        const link = $(this).find('.page-link');
        const page = $(link).attr('href').split('page=')['1'];

        // Create active links 
        $('#news #pagination .page-item').removeClass('active');
        $(this).addClass('active');
       
        getNews(page)

    });

    // Pagination for articles page
    $('#blog .records .page-item').click(function(event) {

        event.preventDefault();

        const link = $(this).find('.page-link');
        const page = $(link).attr('href').split('page=')['1'];

        // Create active links 
        $('#blog #pagination .page-item').removeClass('active');
        $(this).addClass('active');
       
        getNews(page)

    });

    // AJAX request for articles page 
    function getArticles(page)
    {
        $.ajax({
            url: '/articles-content?page=' + page,
            method: 'GET', 
            beforeSend: before()
        }).done(function(data) {
            $('#news .records').html(data);
        });
    }


    // AJAX request for news page
    function getNews(page)
    {
        $.ajax({
            url: '/news-content?page=' + page,
            method: 'GET', 
            beforeSend: before()
        }).done(function(data) {
            $('#news .records').html(data);
        });
    }


    // Show spinner before content was loaded
    function before()
    {
        $('#news .records').html('<div class="col-lg-12 d-flex justify-content-center">'
                        +'<div class="spinner-border" role="status">'
                        +'<span class="sr-only"></span></div></div>');
        
    }

});