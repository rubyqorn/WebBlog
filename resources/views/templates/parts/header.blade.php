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
  <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
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
      <ul class="navbar-nav ml-auto">
        <li class="nav-item p-2">
          <a href="/" class="btn btn-outline-primary" data-toggle="modal" data-target="#login">Войти</a>
        </li>
        <li class="nav-item p-2">
          <a href="/" class="btn btn-outline-primary" data-toggle="modal" data-target="#register">Регистрация</a>
        </li>
      </ul>
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
          <form action="/" class="form-group" method="post">
            <div class="form-group d-flex">
              <i class="fas fa-envelope float-left fa-lg text-black-50 mt-2 mr-2"></i>
              <input type="email" name="email" class="form-control" id="email" placeholder="Почта">
            </div>
            <div class="form-group d-flex">
              <i class="fas fa-lock fa-lg mt-2 mr-2 float-left text-black-50"></i>
              <input type="password" name="password" class="form-control" placeholder="Пароль">
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
        <form action="/" class="form-group" method="post">
          <div class="modal-body">
            <div class="form-group d-flex">
              <i class="fas fa-user float-left text-black-50 mt-2 mr-2 fa-lg"></i>
              <input type="text" name="name" class="form-control" id="name" placeholder="Имя">
            </div> 
            <div class="form-group d-flex">
              <i class="fas fa-envelope float-left text-black-50 mt-2 mr-2 fa-lg"></i>
              <input type="email" class="form-control" name="email" placeholder="Почта">
            </div>
            <div class="form-group d-flex">
              <i class="fas fa-lock float-left text-black-50 mr-2 mt-2 fa-lg"></i>
              <input type="password" name="password" class="form-control" placeholder="Пароль">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-info">Зарегистрироваться</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-6 mt-4 ml-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
      </ol>
    </nav>
  </div>
