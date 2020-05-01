@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    <div id="news">
        <common-navbar-component></common-navbar-component>
        
        <ul class="nav nav-fill shadow border-top">
            @foreach($categories as $category)
                <categories-news-component
                    :name="{{ json_encode($category->name) }}"
                    :color="{{ json_encode($category->color) }}"
                >
                </categories-news-component>
            @endforeach
        </ul>   

        <search-bar-component
            :categories="{{ json_encode($categories) }}"
        ></search-bar-component>

        <div class="container mt-4">
            <div class="row justify-content-center">
                
                <div class="col-lg-10">
                    
                    <news-component></news-component>
                    
                    <div class="col-lg-12">
                        <data-component></data-component> 
                    </div>
                    
                </div>

            </div>
        </div>
        
    </div>
@endsection