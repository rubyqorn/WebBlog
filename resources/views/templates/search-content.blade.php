@extends('templates.app')

@section('title')

    Поиск записи

@endsection

@section('content')

    @if(Request::path('articles/search'))

        <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
            <h4 class="text-black-50 montsserat-font">
                Результаты поиска:
            </h4>
            <hr class="w-50 float-left">
        </div>

        @forelse($articles as $article)
        <div class="container mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-12 mb-4">
                    <div class="card">
                        <div class="card-body bg-dark p-5">
                            <div class="d-flex">
                                <p class="text-light-green miriam-font-family text-uppercase">
                                    {{ date('M d, Y', strtotime($article->created_at)) }}
                                </p>
                            </div>
                            <h4 class="card-title font-weight-bold">
                                <a href="{{ route('article', $article->id) }}" class="text-white miriam-font-family">{{ $article->title }}</a>
                            </h4>

                        </div>
                    </div>
                    </div>

                    

                </div>
            </div>
            
        @empty
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 p-4">
                <h3 class="text-center text-black-50 text-uppercase montserrat-font">
                    <small>
                        Ничего не найдено
                    </small>
                </h3>
            </div>
        @endforelse

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12" id="pagination">
                    <ul class="pagination">
                        {{ $articles->links() }}
                    </ul>
                </div>
            </div>
        </div>
        

    @elseif(Request::path('news/search'))

    <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
            <h4 class="text-black-50 montsserat-font">
                Результаты поиска:
            </h4>
            <hr class="w-50 float-left">
        </div>

    @forelse($news as $item)
        <div class="container mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-12 mb-4">
                    <div class="card">
                        <div class="card-body bg-dark p-5">
                            <div class="d-flex">
                                <p class="text-light-green miriam-font-family text-uppercase">
                                    {{ date('M d, Y', strtotime($item->created_at)) }}
                                </p>
                            </div>
                            <h4 class="card-title font-weight-bold">
                                <a href="{{ route('news', $item->id) }}" class="text-white miriam-font-family">{{ $item->title }}</a>
                            </h4>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 p-4">
                <h3 class="text-center text-black-50 text-uppercase montserrat-font">
                    <small>
                        Ничего не найдено
                    </small>
                </h3>
            </div>
        @endforelse

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12" id="pagination">
                    <ul class="pagination">
                        {{ $news->links() }}
                    </ul>
                </div>
            </div>
        </div>

    @elseif(Request::path('discussions/search'))

    <div class="col-lg-12 col-md-12 col-12 mt-4 mb-4 p-4">
        <h4 class="text-black-50 montsserat-font">
            Результаты поиска:
        </h4>
        <hr class="w-50 float-left">
    </div>

    @forelse($discussions as $discussion)
        <div class="container mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-12 mb-4">
                    <div class="card">
                        <div class="card-body bg-dark p-5">
                            <div class="d-flex">
                                <p class="text-light-green miriam-font-family text-uppercase">
                                    {{ date('M d, Y', strtotime($discussion->created_at)) }}
                                </p>
                            </div>
                            <h4 class="card-title font-weight-bold">
                                <a href="{{ route('news', $discussion->id) }}" class="text-white miriam-font-family">{{ $discussion->title }}</a>
                            </h4>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 p-4">
                <h3 class="text-center text-black-50 text-uppercase montserrat-font">
                    <small>
                        Ничего не найдено
                    </small>
                </h3>
            </div>
        @endforelse

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12" id="pagination">
                    <ul class="pagination">
                        {{ $discussions->links() }}
                    </ul>
                </div>
            </div>
        </div>

    @else

        {{ abort(404) }}

    @endif

@endsection