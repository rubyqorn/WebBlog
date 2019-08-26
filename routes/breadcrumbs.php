<?php

/**
 * Here we can contain and register our breadcrumbs which will 
 * display in the header of our application
*/ 

Breadcrumbs::for('/', function($trail) {
	$trail->push('Главная', route('home'));
});

Breadcrumbs::for('news', function($trail) {
	$trail->push('Новости', route('news'));
});

Breadcrumbs::for('articles', function($trail) {
	$trail->push('Блог', route('articles'));
});

Breadcrumbs::for('discussions', function($trail) {
	$trail->push('Обсуждения', route('discussions'));
});	