@extends('layouts.main')

@section('title')
    Дискуссии
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
        
        <search-bar-component
            :categories="{{ json_encode($categories) }}"
            :route="{{ json_encode('/discussions/search') }}"
            :csrftoken="{{ json_encode(csrf_token()) }}"
        ></search-bar-component>
        
        <div class="container-fluid" id="all-discussions">
            <div class="row">
                <discussions-categories-component
                    :categories="{{ json_encode($categories) }}"
                ></discussions-categories-component>

                <discussions-component
                        :status="{{ json_encode(session('status') ? session('status') : null) }}"
                        :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
                ></discussions-component>

                @if(Auth::user())
                    <ask-question-btn-component
                        :categories="{{ json_encode($categories) }}"
                        :csrf="{{ json_encode(csrf_token()) }}" 
                    >
                    </ask-question-btn-component>
                @endif
            </div>
        </div>
        
        <footer-component></footer-component>
    </div>
@endsection