<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Montserrat|Nunito|Raleway&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
  <title>@yield('title')</title>
</head>
<body class="bg-light-grey">

	  <!-- Navigation panel -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a href="/" class="navbar-brand font-weight-bold">WebBlog</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav left-side-items">
        <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Главная</a></li>
        <li class="nav-item"><a href="{{ route('news') }}" class="nav-link">Новости</a></li>
        <li class="nav-item"><a href="{{ route('articles') }}" class="nav-link">Блог</a></li>
        <li class="nav-item"><a href="{{ route('discussions') }}" class="nav-link">Обсуждения</a></li>
      </ul>

      @if(!Auth::check())

        <ul class="navbar-nav ml-auto">
          <li class="nav-item p-2">
            <a href="/" class="btn btn-outline-primary" data-toggle="modal" data-target="#login">Войти</a>
          </li>
          <li class="nav-item p-2">
            <a href="/" class="btn btn-outline-primary" data-toggle="modal" data-target="#register">Регистрация</a>
          </li>
        </ul>

      @else

        <ul class="navbar-nav ml-auto">
          <li class="nav-item p-2">
            <form action="{{ route('logout') }}" method="post">
              <button type="submit" class="btn btn-outline-info">Выйти</button>
              @csrf
            </form>
          </li>
        </ul>
         
      @endif
       
    </div>
  </nav>

  <!-- Modal windows -->

  <!-- Login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="text-black-50">Войти</h4>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('login') }}" class="form-group" method="post">

            @csrf

            <div class="form-group d-flex">
              <i class="fas fa-envelope float-left fa-lg text-black-50 mt-2 mr-2"></i>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Почта">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-group d-flex">
              <i class="fas fa-lock fa-lg mt-2 mr-2 float-left text-black-50"></i>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Пароль">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-info">Войти</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="register" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="text-black-50">Регистрация</h4>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <form action="/register" class="form-group" method="post">

          @csrf

          <div class="modal-body">
            <div class="form-group">

              <label for="name" class="control-label col-xs-2 nunito-font-family">
                Имя
              </label>

              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="name" required value="{{ old('name') }}">

              @error('name')

                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>

              @enderror

            </div> 

            <div class="form-group">

              <label for="email" class="control-label col-xs-2 nunito-font-family">
                Почта
              </label>

              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" required>

              @error('email')

                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>

              @enderror

            </div>

            <div class="form-group">

              <label for="password" class="control-label col-xs-2 nunito-font-family">
                Пароль
              </label>

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>

            <div class="form-group">

              <label for="confirm" class="control-label col-xs-2 nunito-font-family">
                Повторите пароль
              </label>

             
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            

            </div>

              

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-info">Зарегистрироваться</button>
          </div>
        </form>
      </div>
    </div>
  </div>

