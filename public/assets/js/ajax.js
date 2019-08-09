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

/*
    Pagination for news, discussions and blog pages with ajax
    $('#news #pagination .page-item').click(function(event) {
        event.preventDefault();
        let check = $('#news .records').load('news.php #news .records');
    });

    $('#blog #pagination .page-item').click(function(event) {
        event.preventDefault();
        let check = $('#blog .records').load('blog.php #blog .records');
    })

    $('#discussions #pagination .page-item').click(function(event) {
        event.preventDefault();
        let check = $('#discussions .records').load('discussions.php #discussions .records');
    });
*/

});