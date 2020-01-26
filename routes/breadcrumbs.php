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

Breadcrumbs::for('admin/dashboard', function($trail) {
	$trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('admin/articles', function($trail) {
	$trail->push('Dashboard / Articles', route('articles.index'));
});

Breadcrumbs::for('admin/news', function($trail) {
	$trail->push('Dashboard / News', route('news.index'));
});

Breadcrumbs::for('admin/answers', function($trail) {
	$trail->push('Dashboard / Answers', route('admin.answers'));
});

Breadcrumbs::for('admin/discussions', function($trail) {
	$trail->push('Dashboard / Discussions', route('discussions.index'));
});

Breadcrumbs::for('admin/comments', function($trail) {
	$trail->push('Dashboard / Comments', route('admin.comments'));
});

Breadcrumbs::for('admin/categories', function($trail) {
	$trail->push('Dashboard / Categories', route('admin.categories'));
});

Breadcrumbs::for('admin/articles-categories', function($trail) {
	$trail->push('Dashboard / Articles / Categories', route('admin.articles.categories'));
});

Breadcrumbs::for('admin/news-categories', function($trail) {
	$trail->push('Dashboard / News / Categories', route('admin.news.categories'));
});

Breadcrumbs::for('admin/discussions-categories', function($trail) {
	$trail->push('Dashboard / Discussions / Categories', route('admin.discussions.categories'));
});

Breadcrumbs::for('admin/answers/search', function($trail) {
	$trail->push('Dashboard / Answers / Search', route('answers.search'));
});

Breadcrumbs::for('admin/comments/search', function($trail) {
	$trail->push('Dashboard / Comments / Search', route('comments.search'));
});

Breadcrumbs::for('admin/articles/search', function($trail) {
	$trail->push('Dashboard / Article / Search', route('admin.articles.search'));
});

Breadcrumbs::for('admin/news/search', function($trail) {
	$trail->push('Dashboard / News / Search', route('admin.news.search'));
});

Breadcrumbs::for('admin/discussions/search', function($trail) {
	$trail->push('Dashboard / Discussions / Search', route('admin.discussions.search'));
});