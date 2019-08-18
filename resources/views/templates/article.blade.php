@extends('templates.app')

@section('title')
    
    @if (Request::is('news/*'))

        Новость: {{ $news->title }}

    @elseif (Request::is('article/*'))

        Статья: {{ $article->title }}

    @endif

@endsection

@section('content')

<section class="mt-3 mb-4" id="article">
    <div class="container">
        <div class="row">

            @if(Request::is('news/*'))

            <!-- Article content -->
            <div class="col-lg-8 col-md-8 col-12 p-0 col-6 shadow bg-light">

                <div class="row justify-content-center">
                    <img src="{{ $news->image }}" alt="" class="img-fluid">
                </div>

                <div class="p-4 mt-3">
                    <h2 class="text-center text-black-50 miriam-font-family h1">{{ $news->title }}</h2>
                    <div class="d-flex justify-content-center">
                        <p class="text-black-50 miriam-font-family text-uppercase">
                            <small> 
                                {{ date('M d, Y', strtotime($news->created_at)) }} /
                            </small>
                        </p>
                        <i class="fas fa-tags fa-sm text-black-50 ml-2 mr-1 mt-1"></i>
                        
                        @foreach($news->categories as $category)

                            <p class="text-light-green miriam-font-family text-uppercase">
                                <small>
                                    {{$category->name}}
                                </small>
                            </p>

                        @endforeach
                    
                    </div>
                </div>

                <div class="content mt-4 p-4">
                    <p class="text-dark montserrat-font-family">
                        {{ $news->description }}
                    </p>

                    <hr class="text-black-50 mt-4"> 
                </div>
 

            </div>

            @elseif (Request::is('article/*'))

                <!-- Article content -->
                <div class="col-lg-8 col-md-8 col-12 p-0 col-6 shadow bg-light">

                    <div class="row justify-content-center">
                        <img src="{{ $article->image }}" alt="" class="img-fluid">
                    </div>    

                    <div class="p-4 mt-3">
                        <h2 class="text-center text-black-50 miriam-font-family h1">{{ $article->title }}</h2>
                        <div class="d-flex justify-content-center">
                            <p class="text-black-50 miriam-font-family text-uppercase"><small> {{ date('M d, Y', strtotime($article->created_at)) }} /</small></p>
                            <i class="fas fa-tags fa-sm text-black-50 ml-2 mr-1 mt-1"></i>

                            @foreach($article->categories as $category)
                                <p class="text-light-green miriam-font-family text-uppercase">
                                    <small>
                                        {{ $category->name }}    
                                    </small>
                                </p>
                            @endforeach
                        
                        </div>
                    </div>

                    <div class="content mt-4 p-4">
                        <p class="text-dark montserrat-font-family">
                           {{ $article->description }}
                        </p>
                        
                        <hr class="text-black-50 mt-4">    

                        <div class="comments-section p-4">
                            
                            <!-- Comments form -->
                            @if(Auth::check())
                                <form action="/" class="form-group" method="post">
                                    <div class="form-group">
                                        <textarea name="comment" cols="30" rows="10" class="form-control text-black-50 nunito-font-family" placeholder="Ваш комментарий"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary montserrat-font-family">Отправить</button>
                                    </div>
                                </form>
                            @else
                                <div class="col-lg-12 text-center pt-4 pb-4">
                                    <p class="miriram-font-family text-black-50">
                                        <small>
                                             Чтобы оставить свой комментарий к статье, вы должны 
                                             <a class="text-primary" data-toggle="modal" data-target="#login">войти </a> в свой аккаунт или 
                                             <a data-toggle="modal" data-target="#register" class="text-primary">зарегистрироваться</a> 
                                        </small>
                                    </p>
                                    
                                </div>
                            @endif

                            <!-- Comments -->
                            <div class="comments mt-4">
                                
                                @forelse($comments as $comment)

                                    <div class="d-flex comment mt-3">
                                        <div class="user-info col-lg-4">
                                            <img src="{{ asset('assets/img/default.png') }}" alt="" class="w-50">
                                            <p class="text-black-50 mt-2">{{ $comment->name }}</p>
                                        </div>
                                        <div class="comment">
                                            <p class="text-black-50">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>

                                @empty
                                
                                    <div class="mt-3">
                                        <h4 class="montserrat-font-family font-weight-bold text-black-50 text-center">
                                            Нет комментариев
                                        </h4>
                                    </div>

                                @endforelse

                                
                            </div>
                            
                            <!-- Comments pagination -->
                            <div class="row justify-content-center mt-3">
                                <ul class="pagination">
                                   {{ $comments->links() }}
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>

            @else 

                {{ abort(404) }}

            @endif

           
            
            <!-- Sidebars -->
            <!-- Last articles -->
            <div class="col-lg-4 col-md-4 col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-black-50">
                            Последние {{ Request::is('article/*') ? 'статьи' : 'новости' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (Request::is('article/*'))

                            @foreach($latestArticles as $article)

                                <a href="{{ route('article', $article->id) }}" class="nav-link text-light-green">
                                    {{ $article->title }}
                                </a>
                                <hr>

                            @endforeach
                            
                            
                        @elseif (Request::is('news/*'))

                            @foreach($latestNews as $news)

                                <a href="{{ route('singleNews', $news->id) }}" class="nav-link text-light-green">
                                    {{ $news->title }}
                                </a>
                                <hr>
                            
                            @endforeach


                        @endif
                    </div> 
                </div>

                <!-- Categories -->
                <div class="col-lg-12 col-md-12 col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-black-50">
                                Категории {{ Request::is('article/*') ? 'статей' : 'новостей' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            
                            @if(Request::is('article/*'))

                                @foreach($categories as $category)
                                
                                    <a href="/" class="nav-link text-light-green nunito-font-family">
                                        {{ $category->name }}
                                    </a>
                                    <hr>

                                @endforeach

                            @elseif(Request::is('news/*'))

                                @foreach($categories as $category)
                                    <a href="/" class="nav-link text-light-green nunito-font-family">
                                        {{$category->name}}
                                    </a>
                                    <hr>
                                @endforeach

                            @else

                                <p class="text-light-green">
                                    <small>
                                        Категории не найдены
                                    </small>
                                </p>

                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection