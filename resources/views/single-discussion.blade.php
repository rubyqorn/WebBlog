@extends('layouts.main')

@section('title')
    {{ $discussion['0']->title }}
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
            :answers="{{ json_encode($answers) }}"
            :lastdiscussions="{{ json_encode($lastDiscussions) }}"
        ></single-discussion-component>

        <footer-component></footer-component>
        
    </div>

@endsection