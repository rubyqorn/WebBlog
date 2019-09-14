@extends('templates.admin.app')

@section('title')

	Таблица с категориями

@endsection

@section('content')

	<!-- Main content -->
	<div class="container content mt-4 mb-4 mt-4" id="categories-table">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h3 class="text-left montserrat-font">
                    Выберите категорию
                </h3>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 mt-4 jumbotron p-0 ml-1" id="categories-item">
                <div class="card-img-top ">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-100" alt="">
                </div>
                <div class="text-center">
                    <h4 class="text-center mt-4 mb-4 montserrat-font">
                        Категории новостей
                    </h4>
                    <a href="{{ route('admin.news.categories') }}" class="btn btn-outline-info text-uppercase montserrat-font news mb-4">
                        <small>
                            Смотреть
                        </small>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12 mt-4 jumbotron p-0 ml-1" id="categories-item">
                <div class="card-img-top ">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-100" alt="">
                </div>
                <div class="text-center">
                    <h4 class="text-center mt-4 mb-4 montserrat-font">
                        Категории статей
                    </h4>
                    <a href="{{ route('admin.articles.categories') }}" class="btn btn-outline-info text-uppercase montserrat-font articles mb-4">
                        <small>
                            Смотреть
                        </small>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12 mt-4 jumbotron p-0 ml-1" id="categories-item">
                <div class="card-img-top ">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-100" alt="">
                </div>
                <div class="text-center">
                    <h4 class="text-center mt-4 mb-4 montserrat-font">
                        Категории обсуждений
                    </h4>
                    <a href="{{ route('admin.discussions.categories') }}" class="btn btn-outline-info text-uppercase montserrat-font discussions mb-4">
                        <small>
                            Смотреть
                        </small>
                    </a>
                </div>
            </div>

        </div>
	</div>

@endsection
