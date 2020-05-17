@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="news">
        @if(Auth::user())
            <common-navbar-component
                :usercontent="{{ json_encode([
                    'user' => Auth::user()->name,
                    'csrfToken' => csrf_token()
                ]) }}"
            ></common-navbar-component>

        @else 
            <common-navbar-component></common-navbar-component>
        @endif

        <news-by-category-component
            :news="{{ json_encode($news) }}"
        >
        </news-by-category-component>

        <footer-component></footer-component>

    </div>
@endsection