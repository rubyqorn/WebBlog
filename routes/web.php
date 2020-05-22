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

Route::get('/home', 'HomeController@index')->name('home')->middleware('role');
