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
              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
                      <div class="card-body bg-dark p-5">
                          <div class="d-flex">
                              <i class="fas fa-tags text-white"></i>
                              <p class="text-light-green font-weight-bold text-uppercase ml-2">Something</p>
                              <p class="text-light-green ml-3 miriam-font-family">JUL 21, 2019</p>
                          </div>
                          <h4 class="card-title font-weight-bold">
                              <a href="/article.php" class="text-white miriam-font-family">This is a title about this post</a>
                          </h4>
                      
                      </div>
                  </div>
              </div>

              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
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

              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
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

              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
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

              <div class="col-lg-12 mt-3 rounded">
                  <div class="card">
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
        	
        	<!-- Pagination for articles -->
            <div class="row justify-content-center mt-4" id="pagination">
                <ul class="pagination">
                    <li class="page-item active"><a href="/" class="page-link">1</a></li>
                    <li class="page-item"><a href="/" class="page-link">2</a></li>
                    <li class="page-item"><a href="/" class="page-link">3</a></li>
                    <li class="page-item"><a href="/" class="page-link">4</a></li>
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
                    <a href="/" class="nav-link text-light-green montserrat-font-family">Git</a>
                    <a href="/" class="nav-link text-light-green montserrat-font-family">PHP</a>
                    <a href="/" class="nav-link text-light-green montserrat-font-family">Javascript</a>
                    <a href="/" class="nav-link text-light-green montserrat-font-family">Laravel</a>
                    <a href="/" class="nav-link text-light-green montserrat-font-family">Bootstrap</a>
                    <a href="/" class="nav-link text-light-green montserrat-font-family">HTML/CSS</a>
                </div>
            </div>
        </div>

    </div>

  </div>
</section>

@endsection