@extends('templates.app')

@section('title')
	Обсуждение
@endsection

@section('content')

<!-- Discussion content -->
<section id="discussion" class="mt-3 mb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-7 col-12 mt-3 mb-4 bg-light p-4">
          <h3 class="text-left text-light-green miriam-font-family">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit quos eveniet est suscipit autem sit.
          </h3>
          <span class="badge badge-pill badge-purple">HTML/CSS</span>
          <hr>

          <div class="more-info mt-4 mb-4 mt-4 col-lg-12 col-md-12 col-12">
            <!-- Here will be contain additional information about question. It's can 
              be code or another materials like videos, photos etc...
             -->
          </div>

          <div class="col-lg-12 col-12 col-md-12">
            <form action="/" class="form-group" method="post">
              <div class="form-group">
                <label for="answer" class="control-label col-xs-2 text-black-50 nunito-font-family">Написать ответ</label>
                <textarea name="answer" class="form-control text-black-50 montserrat-font-family" cols="30" rows="10" placeholder="Ответ"></textarea>
              </div>
            </form>
          </div>

        </div>

        <!-- Last questions -->
        <div class="col-lg-5 col-md-5 col-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h4 class="text-left text-black-50">Последние вопросы</h4>
            </div>
            <div class="card-body">
              <a href="/" class="nav-link miriam-font-family text-light-green">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eum et iure 
                tenetur dolor nisi quae aut ut quis praesentium?
              </a>
              <hr>
              <a href="/" class="nav-link miriam-font-family text-light-green">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eum et iure 
                tenetur dolor nisi quae aut ut quis praesentium?
              </a>
              <hr>
              <a href="/" class="nav-link miriam-font-family text-light-green">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eum et iure 
                tenetur dolor nisi quae aut ut quis praesentium?
              </a>
              <hr>
              <a href="/" class="nav-link miriam-font-family text-light-green">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eum et iure 
                tenetur dolor nisi quae aut ut quis praesentium?
              </a>
              <hr>
              <a href="/" class="nav-link miriam-font-family text-light-green">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eum et iure 
                tenetur dolor nisi quae aut ut quis praesentium?
              </a>
              <hr>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-3 mb-3">
          <h2 class="text-left text-black-50">Ответы:</h2>
          <hr>
        </div>

        <!-- Answers -->
        <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 bg-light p-4 d-flex" id="answer">
          <div class="user-info col-lg-4">
            <img src="img/logo.png" alt="sample">
            <p class="text-black-50 nunito-font-family mt-2"><small>Anton Hideger</small></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <p class="text-black-50 nunito-font-family">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
            </p>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 bg-light p-4 d-flex" id="answer">
          <div class="user-info col-lg-4">
            <img src="img/logo.png" alt="sample">
            <p class="text-black-50 nunito-font-family mt-2"><small>Anton Hideger</small></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <p class="text-black-50 nunito-font-family">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
            </p>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 bg-light p-4 d-flex" id="answer">
          <div class="user-info col-lg-4">
            <img src="img/logo.png" alt="sample">
            <p class="text-black-50 nunito-font-family mt-2"><small>Anton Hideger</small></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <p class="text-black-50 nunito-font-family">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
            </p>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 bg-light p-4 d-flex" id="answer">
          <div class="user-info col-lg-4">
            <img src="img/logo.png" alt="sample">
            <p class="text-black-50 nunito-font-family mt-2"><small>Anton Hideger</small></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <p class="text-black-50 nunito-font-family">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
              Nostrum, enim. Odio esse saepe veniam quae, corrupti minima asperiores 
              alias dolorum iste neque necessitatibus minus. Necessitatibus amet blanditiis 
              laudantium tempore magnam voluptatum quos fugit cumque, maxime iusto nulla adipisci sequi nam!
            </p>
          </div>
        </div>

      </div>
		
	  <!-- Pagination for answers -->
      <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
          <ul class="pagination">
            <li class="page-item active"><a href="/" class="page-link">1</a></li>
            <li class="page-item"><a href="/" class="page-link">2</a></li>
            <li class="page-item"><a href="/" class="page-link">3</a></li>
            <li class="page-item"><a href="/" class="page-link">4</a></li>
          </ul>
        </div>
      </div>

    </div>
  </section>

@endsection