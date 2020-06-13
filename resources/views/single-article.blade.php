@extends('layouts.main')

@section('title')
    {{ trim($article->title, '<p></p>') }}
@endsection

@section('content')

    <div id="articles">
        <single-article-component
            :article="{{ json_encode($article) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
        ></single-article-component>

        <footer-component></footer-component>
    </div>

@endsection