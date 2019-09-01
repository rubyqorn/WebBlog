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

Route::get('/', 'HomeController@showPage')
	->name('home');
Route::get('/news', 'NewsController@showPage')
	->name('news');
Route::get('/news/{id}', 'NewsController@newsById')
	->name('singleNews');
Route::get('/news-content', 'AjaxRequestController@getData');
Route::get('/news-categories/{id}', 'AjaxRequestController@recordsByCategory')
	->name('newsCategories');
Route::get('/articles', 'ArticlesController@showPage')
	->name('articles');
Route::get('/article/{id}', 'ArticlesController@showSingleArticle')
	->name('article');
Route::get('/articles-content', 'AjaxRequestController@getData');
Route::get('/articles-categories/{id}', 'AjaxRequestController@recordsByCategory')
	->name('articlesCategories');
Route::get('/discussions', 'DiscussionsController@showPage')
	->name('discussions');
Route::get('/discussion/{id}', 'DiscussionsController@showSingleDiscussion')
	->name('discussion');
Route::get('/discussions-content', 'AjaxRequestController@getData');
Route::get('/discussions-categories/{id}', 'AjaxRequestController@recordsByCategory')
	->name('discussionsCategories');

Route::group(['middleware' => 'auth'], function() {

	Route::post('/store-comment', 'ArticlesController@storeComment')
		->name('storeComment');
	Route::post('/store-answers', 'DiscussionsController@storeAnswers')
		->name('storeAnswers');
	Route::post('/ask-questions', 'DiscussionsController@askQuestions')
		->name('askQuestions');

});

Route::group(['prefix' => 'admin',  'middleware' => ['role', 'auth'], 'namespace' => 'Admin'], function() {

	Route::get('dashboard', 'DashboardController@showPage')
		->name('dashboard');
	Route::get('comments', 'CommentsController@showPage')
		->name('admin.comments');
	Route::get('answers', 'AnswersController@showPage')
		->name('admin.answers');
	Route::get('categories', 'CategoriesController@showPage')
		->name('admin.categories');
	Route::resource('news', 'NewsController');
	Route::resource('articles', 'ArticlesController');
	Route::resource('discussions', 'DiscussionsController');

});

Auth::routes();
