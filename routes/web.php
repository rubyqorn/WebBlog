<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@showPage')
	->name('main');


Route::get('/news', 'NewsController@showPage')
	->name('news');

Route::get('/json-news', 'NewsController@news');

Route::get('/news/{id}', 'NewsController@newsById')
	->name('singleNews');

Route::get('/news/{id}/comments', 'NewsCommentsController@comments')
	->name('newsComments');

Route::post('/news/{id}/comments', 'NewsCommentsController@storeComment')
	->name('storeNewsComment')
	->middleware('auth');

Route::get('/last-comments/news', 'NewsCommentsController@latestComment')
	->name('latestNewsComment')
	->middleware(['auth', 'role']);

Route::get('/news-categories/{id}', 'NewsController@newsByCategory')
	->name('newsCategories');

Route::post('/news/search', 'NewsController@search')
	->name('news.search');


Route::get('/articles', 'ArticlesController@showPage')
	->name('articles');

Route::get('json-articles', 'ArticlesController@articles');

Route::get('/article/{id}', 'ArticlesController@articleById')
	->name('singleArticle');

Route::get('/article/{id}/comments', 'ArticlesCommentsController@comments')
	->name('articleComments');

Route::post('/article/{id}/comments', 'ArticlesCommentsController@storeComment')
	->name('storeArticleComment')
	->middleware('auth');

Route::get('/last-comments/article', 'ArticlesCommentsController@latestComment')
	->name('latestArticleComment')
	->middleware(['auth', 'role']);

Route::get('/articles-categories/{id}', 'ArticlesController@articlesByCategory')
	->name('articlesCategories');

Route::post('/articles/search', 'ArticlesController@search')
	->name('articles.search');


Route::get('/discussions', 'DiscussionsController@showPage')
	->name('discussions');

Route::post('/discussions', 'DiscussionsController@askQuestion')
	->name('askQuestion')
	->middleware('auth');

Route::get('json-discussions', 'DiscussionsController@discussions');

Route::get('/discussion/{id}', 'DiscussionsController@discussionById')
	->name('singleDiscussion');

Route::get('/discussion/{id}/answers', 'AnswersController@answers')
	->name('discussionsAnswers');

Route::post('/discussion/{id}/answers', 'AnswersController@storeAnswers')
	->name('storeDiscussionsAnswers')
	->middleware('auth');

Route::get('/last-answers/discussions/', 'AnswersController@latestAnswer')
	->name('lastDiscussionsAnswers')
	->middleware(['auth', 'role']);

Route::get('/discussions/last-discussions', 'DiscussionsController@lastDiscussions')
	->name('lastDiscussionsList');

Route::get('/discussions-categories/{id}', 'DiscussionsController@discussionsByCategory')
	->name('discussionsCategories');

Route::post('/discussions/search', 'DiscussionsController@search')
	->name('discussions.search');

Auth::routes();

Route::get('/google/redirect', 'Auth\LoginController@redirectToGoogle');
Route::get('/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('github/redirect', 'Auth\LoginController@redirectToGithub');
Route::get('github/callback', 'Auth\LoginController@handleGithubCallback');


Route::get('/home', 'HomeController@index')
	->name('home');
Route::get('/users', 'HomeController@users')
	->name('users');

Route::middleware(['role', 'auth'])->prefix('dashboard')
	->namespace('Admin')
	->group(function() {
	
	Route::get('news', 'NewsController@showPage')
		->name('admin.news');
	Route::get('/news/comments', 'NewsCommentsController@showPage')
		->name('admin.news.comments');
	Route::get('/news/json-comments', 'NewsCommentsController@comments')
		->name('admin.news.json.comments');
	Route::get('/news/categories', 'NewsCategoriesController@showPage')
		->name('admin.news.categories');
	Route::get('/news/json-categories', 'NewsCategoriesController@categories')
		->name('admin.news.json.categories');
	Route::post('/news/search', 'NewsController@search')
		->name('admin.news.search');
	Route::post('/news/categories/search', 'NewsCategoriesController@search')
		->name('admin.news.categories.search');
	Route::post('/news/comments/search', 'NewsCommentsController@search')
		->name('admin.news.comments.search');
	Route::get('/news/create', 'NewsController@create')
		->name('admin.news.create');
	Route::post('/news/create', 'NewsController@store')
		->name('admin.news.store');
	Route::get('/news/categories/create', 'NewsCategoriesController@create')
		->name('admin.news.categories.create');
	Route::post('/news/categories/create', 'NewsCategoriesController@store')
		->name('admin.news.categories.store');

	Route::get('articles', 'ArticlesController@showPage')
		->name('admin.articles');
	Route::get('/articles/json-articles', 'ArticlesController@articles')
		->name('admin.articles.json');
	Route::get('/articles/comments', 'ArticlesCommentsController@showPage')
		->name('admin.articles.comments');
	Route::get('/articles/json-comments', 'ArticlesCommentsController@comments')
		->name('admin.articles.json.comments');
	Route::get('/articles/categories', 'ArticlesCategoriesController@showPage')
		->name('admin.articles.categories');
	Route::get('/articles/json-categories', 'ArticlesCategoriesController@categories')
		->name('admin.articles.json.categories');
	Route::post('/articles/search', 'ArticlesController@search')
		->name('admin.articles.search');
	Route::post('/articles/categories/search', 'ArticlesCategoriesController@search')
		->name('admin.articles.categories.search');
	Route::post('/articles/comments/search', 'ArticlesCommentsController@search')
		->name('admin.articles.comments.search');
	Route::get('/articles/create', 'ArticlesController@create')
		->name('admin.articles.create');
	Route::post('/articles/create', 'ArticlesController@store')
		->name('admin.articles.store');
	Route::get('/articles/categories/create', 'ArticlesCategoriesController@create')
		->name('admin.articles.categories.create');
	Route::post('/articles/categories/create', 'ArticlesCategoriesController@store')
		->name('admin.articles.categories.store');

	Route::get('discussions', 'DiscussionsController@showPage')
		->name('admin.discussions');
	Route::get('/discussions/answers', 'AnswersController@showPage')
		->name('admin.discussions.answers');
	Route::get('/discussions/json-answers', 'AnswersController@answers')
		->name('discussions.json.answers');
	Route::get('/discussions/categories', 'DiscussionsCategoriesController@showPage')
		->name('admin.discussions.categories');
	Route::get('/discussions/json-categories', 'DiscussionsCategoriesController@categories')
		->name('admin.discussions.json.categories');
	Route::post('/discussions/search', 'DiscussionsController@search')
		->name('admin.discussions.search');
	Route::post('/discussions/categories/search', 'DiscussionsCategoriesController@search')
		->name('admin.discussions.categories.search');
	Route::post('/discussions/answers/search', 'AnswersController@search')
		->name('admin.discussions.answers.search');
	Route::get('/discussions/create', 'DiscussionsController@create')
		->name('admin.discussions.create');
	Route::post('/discussions/create', 'DiscussionsController@store')
		->name('admin.discussions.store');
	Route::get('/discussions/categories/create', 'DiscussionsCategoriesController@create')
		->name('admin.discussions.categories.create');
	Route::post('/discussions/categories/create', 'DiscussionsCategoriesController@store')
		->name('admin.discussions.categories.store');
	Route::get('/discussions/answers/create', 'AnswersController@create')
		->name('admin.discussions.answers.create');
	Route::post('/discussions/answers/create', 'AnswersController@store')
		->name('admin.discussions.answers.store');
});