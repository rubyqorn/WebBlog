@extends('layouts.main')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    <div id="news">
        <single-news-component
            :news="{{ json_encode($news) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
            :status="{{ json_encode(session('status') ? session('status') : null) }}"
        ></single-news-component>

        <footer-component></footer-component>
    </div>
@endsection