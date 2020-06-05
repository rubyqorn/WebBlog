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
            :csrf="{{ json_encode($title) }}"
        >
            <slot>
                <create-answers-component
                    :csrf="{{ json_encode(csrf_token()) }}"
                ></create-answers-component>
            </slot>
        </admin-collapsible-sidebar-component>
    </div>
@endsection