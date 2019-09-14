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

	Route::get('/dashboard', 'DashboardController@showPage')
		->name('dashboard');

	Route::get('/comments', 'CommentsController@showPage')
		->name('admin.comments');

	Route::put('/comments/edit/{id}', 'CommentsController@update')
		->name('comments.update');

	Route::delete('/comments/delete/{id}', 'CommentsController@destroy')
		->name('comments.destroy');

	Route::get('/answers', 'AnswersController@showPage')
		->name('admin.answers');

	Route::put('/answers/edit/{id}', 'AnswersController@update')
		->name('answers.update');

	Route::delete('/answers/delete/{id}', 'AnswersController@destroy')
		->name('answers.destroy');

	Route::get('/categories', 'CategoriesController@showPage')
		->name('admin.categories');

	Route::get('/news-categories', 'NewsCategoriesController@showPage')
	    ->name('admin.news.categories');

	Route::get('/articles-categories', 'ArticlesCategoriesController@showPage')
        ->name('admin.articles.categories');

    Route::get('/discussions-categories', 'DiscussionsCategoriesController@showPage')
    	->name('admin.discussions.categories');

    Route::post('/categories/create', 'CategoriesController@store')
    	->name('admin.categories.store');

	Route::put('/categories/update/{id}', 'CategoriesController@update')
        ->name('admin.categories.update');

	Route::delete('/categories/delete/{id}', 'CategoriesController@destroy')
        ->name('admin.categories.delete');

	Route::resource('news', 'NewsController');
	Route::resource('articles', 'ArticlesController');
	Route::resource('discussions', 'DiscussionsController');

});

Auth::routes();
