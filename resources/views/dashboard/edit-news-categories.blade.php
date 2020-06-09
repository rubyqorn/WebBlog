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
                <edit-news-categories-component
                    :csrf="{{ json_encode(csrf_token()) }}"
                ></edit-news-categories-component>
            </slot>
        </admin-collapsible-sidebar-component>
    </div>
@endsection