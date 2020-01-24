$(document).ready(function() {

	$('.navbar-toggler').click(function() {
		$('.content').toggleClass('collapsible-content');
		$('.sidebar').toggleClass('d-block');
	})

	$('.sidebar .navbar-content-item').hover(function() {
		$(this).find('hr').addClass('active-link');
	}, function() {
		$(this).find('hr').removeClass('active-link');
	});

	// Collapsing sidebar 
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});

});

