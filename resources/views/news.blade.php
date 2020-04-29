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
    </div>
@endsection