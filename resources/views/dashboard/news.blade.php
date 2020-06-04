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
                <div class="col-lg-12 p-4 mt-4 shadow bg-white rounded">
                    {!! $chart->container() !!}
                </div>

                <news-table-component>
                    <slot>
                        <search-news-form-component
                            :csrf="{{ json_encode(csrf_token()) }}"
                        ></search-news-form-component>
                    </slot>
                </news-table-component>
            </slot>
        </admin-collapsible-sidebar-component>
    </div>

    {!! $chart->script() !!}
@endsection