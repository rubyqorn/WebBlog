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

Breadcrumbs::for('single-news', function($trail, $news) {
	$trail->parent('news');
	$trail->push($news->title, route('singleNews', $news->id));
});

Breadcrumbs::for('articles', function($trail) {
	$trail->push('Блог', route('articles'));
});

Breadcrumbs::for('article', function($trail, $article) {
	$trail->parent('articles');
	$trail->push($article->title, route('article', $article->id));
});

Breadcrumbs::for('discussions', function($trail) {
	$trail->push('Обсуждения', route('discussions'));
});	

Breadcrumbs::for('discussion', function($trail, $discussion){
	$trail->parent('discussions');
	$tral->push($discussion->title, route('discussion', $discussion->id));
});
