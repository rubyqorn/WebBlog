@extends('layouts.main')

@section('title')
    Дискуссии
@endsection 

@section('content')
    <div id="discussions">
        <common-navbar-component
            :usercontent="{{ json_encode([
                'user' => Auth::user()->name,
                'csrfToken' => csrf_token()
            ]) }}"
        ></common-navbar-component>
        
        <search-bar-component
            :categories="{{ json_encode($categories) }}"
        ></search-bar-component>
        
        <div class="container-fluid">
            <div class="row">
                <discussions-categories-component
                    :categories="{{ json_encode($categories) }}"
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