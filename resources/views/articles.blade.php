@extends('layouts.main')

@section('title')
    Статьи
@endsection

@section('content')

    <div id="articles">
        <common-navbar-component
            :usercontent="{{ json_encode([
                'user' => Auth::user()->name,
                'csrfToken' => csrf_token()
            ]) }}"
        ></common-navbar-component>

        <ul class="nav nav-fill shadow border-top">
            @foreach($categories as $category)
                <categories-component
                    :name="{{ json_encode($category->name) }}"
                    :color="{{ json_encode($category->color) }}"
                >
                </categories-component>
            @endforeach
        </ul>

        <search-bar-component
            :categories="{{ json_encode($categories) }}"
        >
        </search-bar-component>

        <div class="container mt-4">
            <div class="row justify-content-center">

                <social-links-sidebar-component></social-links-sidebar-component>

                <div class="col-lg-10">
                    <articles-component></articles-component>
                </div>

            </div>
        </div>
    
        <footer-component></footer-component>

    </div>

@endsection