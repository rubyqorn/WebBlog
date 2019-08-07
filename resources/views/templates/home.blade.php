@extends('templates.app')

@section('title')
	Главная
@endsection

@section('content')

	<section class="mt-3 mb-4" id="home">
	    <div class="container">
	      <div class="row">
	        <div class="col-lg-6 col-md-6 col-sm-12">

	          <div class="col-lg-12 mt-3">
	            <div class="card">
	              <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	              <div class="card-body bg-dark p-5">
	                <div class="d-flex">
	                  <i class="fas fa-tags text-white"></i>
	                  <p class="text-light-green font-weight-bold text-uppercase ml-2">Something</p>
	                  <p class="text-light-green ml-3 miriam-font-family">JUL 21, 2019</p>
	                </div>
	                <h4 class="card-title font-weight-bold">
	                  <a href="/" class="text-white miriam-font-family">This is a title about this post</a>
	                </h4>
	                
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-5 col-sm-12 col-md-5 float-right mt-2 mb-4">

	          <div class="col-lg-12 mt-2t">
	            <div class="shadow p-3 bg-light">
	              <h4 class="miriam-font-family">
	                <a href="/" class="text-light-green">Lorem ipsum dolor sit amet consectetur.</a>
	              </h4>
	              <p class="text-black-50">
	                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime.
	              </p>
	              <div class="d-flex">
	                <span class="badge badge-pill badge-purple">GIT</span>
	              </div>
	            </div>
	          </div>

	          <div class="col-lg-12 mt-2">
	            <div class="shadow p-3 bg-light">
	              <h4 class="miriam-font-family">
	                <a href="/" class="text-light-green">Lorem ipsum dolor sit amet consectetur.</a>
	              </h4>
	              <p class="text-black-50">
	                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime.
	              </p>
	              <div class="d-flex">
	                <span class="badge badge-pill badge-purple">GIT</span>
	              </div>
	            </div>
	          </div>

	          <div class="col-lg-12 mt-2">
	            <div class="shadow p-3 bg-light">
	              <h4 class="miriam-font-family">
	                <a href="/" class="text-light-green">Lorem ipsum dolor sit amet consectetur.</a>
	              </h4>
	              <p class="text-black-50">
	                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime.
	              </p>
	              <div class="d-flex">
	                <span class="badge badge-pill badge-purple">GIT</span>
	              </div>
	            </div>
	          </div>

	          <div class="col-lg-12 mt-2">
	            <div class="shadow p-3 bg-light">
	              <h4 class="miriam-font-family">
	                <a href="/" class="text-light-green">Lorem ipsum dolor sit amet consectetur.</a>
	              </h4>
	              <p class="text-black-50">
	                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime.
	              </p>
	              <div class="d-flex">
	                <span class="badge badge-pill badge-purple">GIT</span>
	              </div>
	            </div>
	          </div>

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

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-3 col-md-5 col-sm-12 mr-3 mt-2">
	          <div class="card">
	            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="card-img-top">
	            <div class="card-body bg-dark">
	              <h5 class="card-title">
	                <a href="/" class="miriam-font-family text-white">This is a simple title</a>
	              </h5>
	              <div class="d-flex">
	                <i class="fas fa-tags text-white"></i>
	                <p class="text-light-green ml-2 miriam-font-family">Javascipt</p>
	                <p class="text-light-green miriam-font-family ml-3 text-uppercase">JUL 11, 2019</p>
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-lg-12 text-center mt-4">
	         <a href="/" class="btn btn-outline-primary montserrat-font-family">Посмотреть больше</a> 
	        </div>

	      </div>

	    </div>
	 </section>

@endsection 