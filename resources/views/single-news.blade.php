@extends('layouts.main')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    <div id="news">
        <single-news-component
            :news="{{ json_encode($news) }}"
            :comments="{{ json_encode($comments) }}"
        ></single-news-component>

        <footer-component></footer-component>
    </div>
@endsection