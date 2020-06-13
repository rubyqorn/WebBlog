@extends('layouts.main')

@section('title')
    {{ trim($news->title, '<p></p>') }}
@endsection

@section('content')
    <div id="news">
        <single-news-component
            :news="{{ json_encode($news) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
        ></single-news-component>

        <footer-component></footer-component>
    </div>
@endsection