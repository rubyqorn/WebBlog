@extends('layouts.main')

@section('title')
    {{ $article->title }}
@endsection

@section('content')

    <div id="articles">
        <single-article-component
            :article="{{ json_encode($article) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
            :status="{{ json_encode(session('status') ? session('status') : null) }}"
            :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
        ></single-article-component>

        <footer-component></footer-component>
    </div>

@endsection