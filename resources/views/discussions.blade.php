@extends('layouts.main')

@section('title')
    Дискуссии
@endsection 

@section('content')
    <div id="discussions">
        @if(Auth::user())
            <common-navbar-component
                :usercontent="{{ json_encode([
                    'user' => Auth::user()->name,
                    'csrfToken' => csrf_token()
                ]) }}"
            ></common-navbar-component>
        @endif

        <common-navbar-component></common-navbar-component>
        
        <search-bar-component
            :categories="{{ json_encode($categories) }}"
        ></search-bar-component>
        
        <div class="container-fluid" id="all-discussions">
            <div class="row">
                <discussions-categories-component
                    :categories="{{ json_encode($categories) }}"
                    :route="{{ json_encode('/news/search') }}"
                    :csrftoken="{{ json_encode(csrf_token()) }}"
                ></discussions-categories-component>

                <discussions-component></discussions-component>

                <ask-question-btn-component
                    :categories="{{ json_encode($categories) }}"
                >
                </ask-question-btn-component>
            </div>
        </div>
        
        <footer-component></footer-component>
    </div>
@endsection