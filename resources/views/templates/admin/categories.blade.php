@extends('templates.admin.app')

@section('title')

	Таблица с категориями

@endsection

@section('content')

    <!-- Main content -->
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-xs-12 p-4 d-flex justify-content-between bg-grey">
				<div class="greeting">
					
					<a href="{{ Request::path() }}" class="text-muted">
						<small>
							{{ Breadcrumbs::render(Request::path()) }}
						</small>
					</a>
					
					<div class="d-flex">
						<i class="far fa-hand-pointer text-muted mt-1 mr-2"></i>
						<p class="h4 text-muted nunito-font">
							<strong>Categories</strong> Selection
						</p>
					</div>
				</div>
				<div class="date">
					<p class="text-black-50 font-weight-bold montserrat-font">
						20 JAN 2020
					</p>
				</div>
			</div>

            <div class="col-lg-12 col-md-12 col-12 mt-4">
                <h3 class="text-left montserrat-font">
                    Выберите категорию
                </h3>
            </div>

            <div class="col-lg-8 p-0 m-2 shadow bg-white" id="category">
               <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">
                        <img src="/assets/img/articles-category-background.jpg" class="w-100" alt="">
                    </div>
                    <div class="d-none" id="category-content">
                        <a href="{{ route('admin.articles.categories') }}" class="text-white font-weight-bold nunito-font">
                            Articles categories
                        </a>
                        <p class="text-white text-center">
                            <i class="fas fa-eye"></i>
                        </p>
                    </div>
               </div>
            </div>

            <div class="col-lg-8 p-0 m-2 shadow bg-white" id="category">
               <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">
                        <img src="/assets/img/news-category-background.jpg" class="w-100" alt="">
                    </div>
                    <div class="d-none" id="category-content">
                        <a href="{{ route('admin.articles.categories') }}" class="text-white font-weight-bold nunito-font">
                            News categories
                        </a>
                        <p class="text-white text-center">
                            <i class="fas fa-eye"></i>
                        </p>
                    </div>
               </div>
            </div>

            <div class="col-lg-8 p-0 m-2 shadow bg-white" id="category">
               <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">
                        <img src="/assets/img/discussions-category-background.jpg" class="w-100" alt="">
                    </div>
                    <div class="d-none" id="category-content">
                        <a href="{{ route('admin.articles.categories') }}" class="text-white font-weight-bold nunito-font">
                            Discussions categories
                        </a>
                        <p class="text-white text-center">
                            <i class="fas fa-eye"></i>
                        </p>
                    </div>
               </div>
            </div>

        </div>
    </div>

@endsection
