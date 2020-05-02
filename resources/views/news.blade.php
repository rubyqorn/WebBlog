@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    <div id="news">
        <common-navbar-component></common-navbar-component>
        
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
        ></search-bar-component>

        <div class="container mt-4">
            <div class="row justify-content-center">
                
                <social-links-sidebar-component></social-links-sidebar-component>

                <div class="col-lg-10">
                    <news-component></news-component>
                </div>

            </div>
        </div>

        <footer-component></footer-component>
        
    </div>
@endsection