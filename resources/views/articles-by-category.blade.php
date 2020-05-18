@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="articles">
        @if(Auth::user())
            <common-navbar-component
                :user="{{ json_encode(Auth::user()->name) }}"
                :csrf="{{ json_encode(csrf_token()) }}"
            ></common-navbar-component>

        @else 
            <common-navbar-component></common-navbar-component>
        @endif

        
        <articles-by-category-component
            :articles="{{json_encode($articles)}}"
        ></articles-by-category-component>

        <footer-component></footer-component>
        
    </div>
@endsection