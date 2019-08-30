@extends('templates.app')

@section('title')
	Главная
@endsection

@section('content')

  <div class="col-lg-3 col-md-3 col-6 mt-4 ml-4">
    <a href="{{ Request::path() }}">
      {{ Breadcrumbs::render(Request::path()) }}
    </a>
  </div>

	<section class="mt-3 mb-4" id="home">
	    <div class="container">
	      <div class="row">
	        <div class="col-lg-6 col-md-6 col-sm-12">
			  
			  @foreach($lastNews as $news)
		          <div class="col-lg-12 mt-3">
		            <div class="card">
		              <img src="{{ $news->image }}" alt="" class="card-img-top">
		              <div class="card-body bg-dark p-5">
		                <div class="d-flex">
		                  <i class="far fa-clock text-white mt-1"></i>
		                  <p class="text-light-green ml-2 miriam-font-family text-uppercase">{{ date('M d, Y', strtotime($news->created_at)) }}</p>
		                </div>
		                <h4 class="card-title font-weight-bold">
		                  <a href="{{ route('singleNews', $news->id) }}" class="text-white miriam-font-family">{{ $news->title }}</a>
		                </h4>
		                
		              </div>
		            </div>
		          </div>
	          @endforeach

	        </div>

	        <div class="col-lg-5 col-sm-12 col-md-5 float-right mt-2 mb-4">

				@foreach($newsItems as $news)
				
		          <div class="col-lg-12 mt-2">
		            <div class="shadow p-3 bg-light">
		              <h4 class="miriam-font-family">
		                <a href="{{ route('singleNews', $news->id) }}" class="text-light-green">{{ $news->title }}</a>
		              </h4>
		              <p class="text-black-50">
              			{{ $news->preview_text }}
		              </p>
		              <div class="d-flex">
		              	<i class="fas fa-clock text-black-50 mt-1"></i>
		              	<p class="miriam-font-family text-black-50 text-uppercase ml-2">
		              		{{ date('M d, Y', strtotime($news->created_at)) }}
		              	</p>
		              </div>
		            </div>
		          </div>

	          @endforeach

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

			@foreach($articles as $article)

		        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
		          <div class="card">
		            <img src="{{ $article->image }}" alt="" class="card-img-top">
		            <div class="card-body bg-dark">
		              <h5 class="card-title">
		                <a href="{{ route('article', $article->id) }}" class="miriam-font-family text-white">{{ $article->title }}</a>
		              </h5>
		              <div class="d-flex">
		                <i class="fas fa-tags text-white"></i>
		                <p class="text-light-green ml-2 miriam-font-family">{{ $article->name }}</p>
		                <p class="text-light-green miriam-font-family ml-3 text-uppercase">{{ $article->created_at }}</p>
		              </div>
		            </div>
		          </div>
		        </div>

	        @endforeach

	        <div class="col-lg-12 text-center mt-4">
	         <a href="{{ route('articles') }}" class="btn btn-outline-primary montserrat-font-family">Посмотреть больше</a> 
	        </div>

	      </div>

	    </div>
	 </section>

@endsection 