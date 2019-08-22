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

    /**
    * Pagination with AJAX for news page.
    * When we click on pagination element we call two functions.
    * 1st function add active class for pagination element and
    * second function we need for processing ajax request.
    */ 
    $('#news #pagination .page-item').click(function(event) {
        event.preventDefault();

        const link = $(this).find('.page-link');
        const page = $(link).attr('href').split('page=')['1'];
        const url = '/news-content?page=' + page;

        // Create active links 
        addActiveClass('#news #pagination .page-item', this);

        // Call processing AJAX request
        ajaxRequestHandler(url, '#news .records');

    });

    /**
    * Pagination with AJAX for articles page.
    * When we click on pagination element we call two functions.
    * 1st function add active class for pagination element and
    * second function we need for processing ajax request.
    */ 
    $('#blog #pagination .page-item').click(function(event) {

        event.preventDefault();

        const link = $(this).find('.page-link');
        const page = $(link).attr('href').split('page=')['1'];
        const url = '/articles-content?page=' + page;

        // Create active links 
        addActiveClass('#blog #pagination .page-item', this);

        // Call processing AJAX request
        ajaxRequestHandler(url, '#blog .records');

    });

    /**
    * Pagination with AJAX for discussions page.
    * When we click on pagination element we call two functions.
    * 1st function add active class for pagination element and
    * second function we need for processing ajax request.
    */ 
    $('#discussions #pagination .page-item').click(function(event) {

        event.preventDefault();

        const link = $(this).find('.page-link');
        const page = $(link).attr('href').split('page=')['1'];
        const url = '/discussions-content?page=' + page;

        // Create active links 
        addActiveClass('#discussions #pagination .page-item', this);
        
        // Call processing AJAX request
        ajaxRequestHandler(url, '#discussions .table tbody');
        

    });

    /**
    * Show spinner before content was loaded completely
    *
    * @param section - Section where we have to load our spinner 
    */ 
    function before(section)
    {
        $(section).fadeIn(3000, function() {
            $(section).html('<div class="col-lg-12 d-flex justify-content-center">'
                        +'<div class="spinner-border" role="status">'
                        +'<span class="sr-only"></span></div></div>');
        })

        
        
    }

    /**
    * Processing AJAX request
    *
    * @param url - Url where we get data for our section
    * @param dataSection - Section where we display data and spinner
    */ 
    function ajaxRequestHandler(url, dataSection)
    {
        $.ajax({
            url: url,
            beforeSend: before(dataSection)
        })
        .done(function(data) {
              $(dataSection).html(data);
        })
        .fail(function() {
            $(dataSection).html('<h2 class="text-center text-black-50">Нет постов</h2>');
        });
    }

    /**
    * Add active link for button which was clicked 
    *
    * @param section - Section with all pagination elements 
    * @param activeElem - Active element which was clicked
    */
    function addActiveClass(section, activeElem)
    {
        $(section).removeClass('active');
        $(activeElem).addClass('active');
    }

});