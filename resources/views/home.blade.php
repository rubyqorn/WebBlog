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
            <slot name="header">

                <div class="row mt-4">
                    <div class="col-lg-5 ml-4 bg-white shadow p-4 rounded">
                        {!! $commentsChart->container() !!}
                    </div>
                    <div class="col-lg-5 ml-4 bg-white shadow p-4 rounded">
                        {!! $answersChart->container() !!}       
                    </div>

                    <users-list-component></users-list-component>
                    
                    <admin-footer-component></admin-footer-component>
                </div>

            </slot>
        </admin-collapsible-sidebar-component>
            
    </div>

    {!! $commentsChart->script() !!}
    {!! $answersChart->script() !!}
@endsection 
