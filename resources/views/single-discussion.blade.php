@extends('layouts.main')

@section('title')
    {{ trim($discussion['0']->title, '<p></p>') }}
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

        <single-discussion-component
            :discussion="{{ json_encode($discussion) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
        ></single-discussion-component>

        <footer-component></footer-component>
        
    </div>

@endsection