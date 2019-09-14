@extends('templates.app')

@section('title')
	Блог
@endsection

@section('content')

  <div class="col-lg-3 col-md-3 col-6 mt-4 ml-4">
    <a href="{{ Request::path() }}">
      {{ Breadcrumbs::render(Request::path()) }}
    </a>
  </div>


<section class="mt-3 mb-4" id="blog">
  <div class="container">
      <div class="row">

		<!-- All records -->
        <div class="col-lg-7 col-md-7 col-sm-12">

            <div class="col-lg-12" id="categories-title"></div>

            <div class="records">

            @foreach($articles as $article)
              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
                      <div class="card-body bg-dark p-5">
                          <div class="d-flex">
                              <i class="fas fa-tags text-white"></i>
                              <p class="text-light-green font-weight-bold text-uppercase ml-2">{{ $article->name }}</p>
                              <p class="text-light-green ml-3 miriam-font-family text-uppercase">
                                {{ date('M d, Y', strtotime($article->created_at)) }}
                              </p>
                          </div>
                          <h4 class="card-title font-weight-bold">
                              <a href="{{ route('article', $article->id) }}" class="text-white miriam-font-family">{{ $article->title }}</a>
                          </h4>

                      </div>
                  </div>
              </div>
            @endforeach

            </div>

        	<!-- Pagination for articles -->
            <div class="row justify-content-center mt-4" id="pagination">
                <ul class="pagination">
                    {{ $articles->links() }}
                </ul>
            </div>

        </div>

		<!-- Right sidebar where contains articles categories -->
        <div class="col-lg-5 col-md-5 col-sm-12 mt-3" id="categories">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-black-50 h4">Категории статей</h4>
                </div>
                <div class="card-body">
                    @foreach($categories as $category)
                        <a href="{{ route('articlesCategories', $category->category_id) }}" class="nav-link text-light-green montserrat-font-family">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

  </div>
</section>

@endsection
