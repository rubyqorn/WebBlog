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
            :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
        ></single-news-component>

        <footer-component></footer-component>
    </div>
@endsection