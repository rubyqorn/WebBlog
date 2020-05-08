@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="articles">
        <common-navbar-component></common-navbar-component>
        
        <articles-by-category-component
            :articles="{{json_encode($articles)}}"
        ></articles-by-category-component>
        
    </div>
@endsection