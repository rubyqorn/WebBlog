@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div id="dashboard">
        <admin-navbar-component
            :user="{{ json_encode(Auth::user()->name) }}"
            :csrf="{{ json_encode(csrf_token()) }}"
        ></admin-navbar-component>

        <admin-collapsible-sidebar-component
            :title="{{ json_encode($title) }}"
        >
            <slot>
                <create-news-categories-component
                    :csrf="{{ json_encode(csrf_token()) }}"
                ></create-news-categories-component>
            </slot>

            <admin-footer-component></admin-footer-component>
        </admin-collapsible-sidebar-component>
    </div>
@endsection