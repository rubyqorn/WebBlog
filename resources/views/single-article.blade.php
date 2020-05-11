@extends('layouts.main')

@section('title')
    {{ $article->title }}
@endsection

@section('content')

    <div id="articles">
        <single-article-component
            :article="{{ json_encode($article) }}"
            :comments="{{ json_encode($comments) }}"
        ></single-article-component>

        <footer-component></footer-component>
    </div>

@endsection