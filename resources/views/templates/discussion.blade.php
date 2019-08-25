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
            {{ $discussion->title }}
          </h3>

          @foreach($discussion->categories as $category)
            <span class="badge badge-pill badge-purple">{{ $category->name }}</span>
          @endforeach
          
          <hr>

          <div class="more-info mt-4 mb-4 mt-4 col-lg-12 col-md-12 col-12">

            @if($discussion->image)
                <img src="{{ $discussion->image }}" alt="{{ $discussion->title }}">
            @endif

            <p class="text-black-50 montserrat-font-family font-weight-bold mt-3 mb-3">
                {{ $discussion->description }}
            </p>
          </div>

          <!-- Displaying errors when we get an errors from validator -->
          <div class="col-lg-12">
              @if($errors->any())

                  <div class="alert bg-dark-red alert-dismissable fade show text-center" role="alert">
                      <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                      </button>
                      @foreach($errors->all() as $error)
                          <p class="text-lowercase text-white montserrat-font-family">
                              <small>
                                  <strong>{{ $error }}</strong>
                              </small>
                          </p>
                      @endforeach
                  </div>

              @endif
          </div>

          @if(Auth::check())

              <div class="col-lg-12 col-12 col-md-12">
                <form action="{{ route('storeAnswers') }}" class="form-group" method="post">

                  @csrf

                  <div class="form-group">
                    <label for="response" class="control-label col-xs-2 text-black-50 nunito-font-family">Написать ответ</label>

                    <textarea name="response" class="form-control text-black-50 montserrat-font-family" cols="30" rows="10" placeholder="Ответ"></textarea>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="id" value="{{ $discussion->id }}">
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info">Отправить</button>
                  </div>
                </form>
              </div>

          @else
    
            <div class="col-lg-12 col-md-12 col-12 text-center">
                <p class="text-center miriam-font-family text-black-50">
                    <small>
                        Чтобы оставить свой ответ к вопросу, вы должны 
                         <a class="text-primary" data-toggle="modal" data-target="#login">войти </a> в свой аккаунт или 
                         <a data-toggle="modal" data-target="#register" class="text-primary">зарегистрироваться</a> 
                    </small>
                </p>
            </div>

          @endif

        </div>

        <!-- Last questions -->
        <div class="col-lg-5 col-md-5 col-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h4 class="text-left text-black-50">Последние вопросы</h4>
            </div>
            <div class="card-body">

              @foreach($latestDiscussions as $discussions)  

                  <a href="{{ route('discussion', $discussions->id) }}" class="nav-link miriam-font-family text-light-green">
                    {{ $discussions->title }}
                  </a>
                  <hr>

               @endforeach

            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-3 mb-3">
          <h2 class="text-left text-black-50">Ответы:</h2>
          <hr>
        </div>

        <!-- Answers -->
        @forelse($answers as $answer)
            <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 bg-light p-4 d-flex" id="answer">
              <div class="user-info col-lg-4">
                <img src="{{ asset('assets/img/default.png') }}" alt="sample">
                <p class="text-black-50 nunito-font-family mt-2">
                    <small>
                        {{ $answer->name }}
                    </small>
                </p>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12">
                <p class="text-black-50 nunito-font-family">
                  {{ $answer->answer }}
                </p>
              </div>
            </div>
        @empty
            <div class="col-lg-7 col-md-7 col-12 mt-3 mb-2 p-4" id="answer">
                <h4 class="montserrat-font-family font-weight-bold text-black-50 text-center">
                    Нет ответов
                </h4>
            </div>
        @endforelse

      </div>
		
	  <!-- Pagination for answers -->
      <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
          <ul class="pagination">
            {{ $answers->links() }}
          </ul>
        </div>
      </div>

    </div>
  </section>

@endsection