@extends('layouts.main')

@section('title')
    Дискуссии по категории
@endsection

@section('content')
    <div id="discussions">
        @if(Auth::user())
            <common-navbar-component
                :user="{{ json_encode(Auth::user()->name) }}"
                :csrf="{{ json_encode(csrf_token()) }}"
            ></common-navbar-component>

        @else 
            <common-navbar-component></common-navbar-component>
        @endif

        <div class="container mt-4" id="discussions-by-category">
            <div class="row justify-content-center">

                <discussions-categories-component
                    :categories="{{ json_encode($categories) }}"
                ></discussions-categories-component>

                <discussions-by-category-component
                    :discussions="{{ json_encode($discussions) }}"
                ></discussions-by-category-component>
            </div>
        </div>

        <footer-component></footer-component>

    </div>
@endsection