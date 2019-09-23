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

Route::get('/articles/search', 'ArticlesController@search')
		->name('articles.search');

Route::get('/news/search', 'NewsController@search')
	->name('news.search');

Route::get('/discussions/search', 'DiscussionsController@search')
	->name('discussions.search');

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

	Route::post('/articles-categories/create', 'ArticlesCategoriesController@storeCategories')
		->name('admin.articles.categories.store');

	Route::put('/articles-categories/edit/{id}', 'ArticlesCategoriesController@updateCategories')
		->name('admin.articles.categories.update');

	Route::delete('/articles-categories/delete/{id}', 'ArticlesCategoriesController@destroyCategories')
		->name('admin.articles.categories.delete');

	Route::post('/news-categories/create', 'NewsCategoriesController@storeCategories')
		->name('admin.news.categories.store');

	Route::put('/news-categories/edit/{id}', 'NewsCategoriesController@updateCategories')
		->name('admin.news.categories.update');

	Route::delete('/news-categories/delete/{id}', 'NewsCategoriesController@destroyCategories')
		->name('admin.news.categories.delete');

	Route::post('/discussions-categories/create', 'DiscussionsCategoriesController@storeCategories')
		->name('admin.discussions.categories.store');

	Route::put('/discussions-categories/edit/{id}', 'DiscussionsCategoriesController@updateCategories')
		->name('admin.discussions.categories.update');
	
	Route::delete('/discussions-categories/delete/{id}', 'DiscussionsCategoriesController@destroyCategories')
		->name('admin.discussions.categories.delete');

	Route::resource('news', 'NewsController');
	Route::resource('articles', 'ArticlesController');
	Route::resource('discussions', 'DiscussionsController');

});

Auth::routes();
