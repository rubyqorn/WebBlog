@extends('templates.app')

@section('title')
	Главная
@endsection

@section('content')


	<section class="mt-3 mb-4" id="home">
	    <div class="container">
	      <div class="row">
	        <div class="col-lg-6 col-md-6 col-sm-12">
			  
			  <x-news-at-home-page :lastNews="$lastNews" />

	        </div>

	        <div class="col-lg-5 col-sm-12 col-md-5 float-right mt-2 mb-4">

				<x-last-five-news-at-home-page :news="$news" />

	        </div>

	      </div>

	      <div class="row justify-content-center">

	         <!-- Title -->
	         <div class="col-lg-12 mb-4 mt-3">
	          <h2 class="text-left text-black-50">
	            Статьи
	          </h2>
	          <hr class="w-50 float-left">
	        </div>

			<x-last-articles-at-home-page :articles="$articles" />

	        <div class="col-lg-12 text-center mt-4">
	        	<a href="{{ route('articles') }}" class="btn btn-outline-primary montserrat-font-family">Посмотреть больше</a> 
	        </div>

	      </div>

	    </div>
	 </section>

@endsection 