@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="articles">
        @if(Auth::user())
            <common-navbar-component
                :usercontent="{{ json_encode([
                    'user' => Auth::user()->name,
                    'csrfToken' => csrf_token()
                ]) }}"
            ></common-navbar-component>
        @endif

        <common-navbar-component></common-navbar-component>
        
        <articles-by-category-component
            :articles="{{json_encode($articles)}}"
        ></articles-by-category-component>

        <footer-component></footer-component>
        
    </div>
@endsection