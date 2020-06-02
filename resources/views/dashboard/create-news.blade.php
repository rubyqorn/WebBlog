@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="dashboard">
        <admin-navbar-component
            :csrf="{{ json_encode(csrf_token()) }}"
            :user="{{ json_encode(Auth::user()->name) }}"
        ></admin-navbar-component>

        <admin-collapsible-sidebar-component
            :title="{{ json_encode($title) }}"
        >
            <slot>
                <create-news-component
                    :csrf="{{ json_encode(csrf_token()) }}"
                    :categories="{{ json_encode($categories) }}"
                ></create-news-component>
            </slot>

            <admin-footer-component></admin-footer-component>
        </admin-collapsible-sidebar-component>

        
    </div>
@endsection