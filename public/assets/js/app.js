$(document).ready(function() {
   
    // Active links from navigation panel
    const links = $('nav .left-side-items .nav-item');

    $(links).click(function() {
        $(links).removeClass('active');
        $(this).addClass('active');
    });

    // Focus on email input when click on login button
    $('#login').on('shown.bs.modal', function () {
        $('#email').trigger('focus')
    })

    // Focus on name input when click on register button
    $('#register').on('shown.bs.modal', function() {
        $('#name').trigger('focus');
    });

    // Show search form by clicking
    $('#search-form .form-group .fas').click(function() {
        $('#search-form .search-button').addClass('justify-content-end');
        $('#search-form .search-form').toggleClass('d-none');
    });

})

