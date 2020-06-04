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
                <create-articles-component
                    :csrf="{{ json_encode(csrf_token()) }}"
                    :categories="{{ json_encode($categories) }}"
                ></create-articles-component>
            </slot>
        </admin-collapsible-sidebar-component>
    </div>
@endsection