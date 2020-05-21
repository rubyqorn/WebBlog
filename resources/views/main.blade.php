@extends('layouts.main')

    @section('title')
        Главная
    @endsection

    @section('content')
        <div id="app">
            

            <div class="container">
                <div class="row justify-content-center">
                    <header-component
                        :title="{{ json_encode($title) }}"
                    >
                    </header-component>

                    <navbar-component
                        :mainpage="{{ json_encode(route('main')) }}"
                        :newspage="{{ json_encode(route('news')) }}"
                        :articlespage="{{ json_encode(route('articles')) }}"
                        :discussionspage="{{ json_encode(route('discussions')) }}"
                    >
                    </navbar-component>

                </div>
            </div>

            <div class="container mt-4">
                <div class="row justify-content-center">
                    <article-component
                            :category="{{ json_encode($article->category->name) }}"
                            :title="{{ json_encode($article->title) }}"
                            :author="{{ json_encode($article->author->name) }}"
                            :date="{{ json_encode(date('d.m.Y', strtotime($article->created_at))) }}"
                            :route="{{ json_encode(route('singleArticle', $article->id)) }}"
                        >
                    </article-component>
                </div>
            </div>

        <footer-component></footer-component>

    @endsection
