@extends('templates.app')

@section('title')
	Блог
@endsection

@section('content')
	
<!-- Search form where we can find articles -->
<div class="container mt-4" id="search-form">
    <div class="row justify-content-center">

      <div class="col-lg-12 d-flex text-center">
        <i class="fas fa-search fa-2x"></i>
        <div class="search-form col-lg-12">
          <form action="/" class="form-group" method="get">
            <div class="form-group">
              <input type="search" name="search" class="form-control" placeholder="Поиск" id="search">
            </div>
          </form>
        </div>
      </div>

      <div id="result">
        <div class="col-lg-12 d-flex">
          <div class="content">
            <a href="/" class="text-black-50 font-weight-bold"><!-- content from search field --></a> 
          </div>
        </div>
      </div>

    </div>
  </div>

<section class="mt-3 mb-4" id="blog">
  <div class="container">
      <div class="row">
		
		<!-- All records -->
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="records">

            @foreach($articles as $article)
              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
                      <div class="card-body bg-dark p-5">
                          <div class="d-flex">
                              <i class="fas fa-tags text-white"></i>
                              <p class="text-light-green font-weight-bold text-uppercase ml-2">{{ $article->name }}</p>
                              <p class="text-light-green ml-3 miriam-font-family">{{ $article->created_at }}</p>
                          </div>
                          <h4 class="card-title font-weight-bold">
                              <a href="/article.php" class="text-white miriam-font-family">{{ $article->title }}</a>
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
                        <a href="/" class="nav-link text-light-green montserrat-font-family">
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