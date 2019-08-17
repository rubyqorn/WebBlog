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

Route::get('/', 'HomeController@showPage')->name('home');
Route::get('/news', 'NewsController@showPage')->name('news');
Route::get('/news/{id}', 'NewsController@newsById')->name('singleNews');
Route::get('/articles', 'ArticlesController@showPage')->name('articles');
Route::get('article/{id}', 'ArticlesController@showSingleArticle')->name('article');
Route::get('/discussions', 'DiscussionsController@showPage')->name('discussions');
