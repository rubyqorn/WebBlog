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
                <div class="col-lg-12 mt-4 p-4 rounded bg-white shadow">
                    {!! $chart->container() !!}
                </div>

                <news-comments-table-component>
                    <slot>
                        <search-news-comments-form-component
                            :csrf="{{ json_encode(csrf_token()) }}"
                        ></search-news-comments-form-component>
                    </slot>
                </news-comments-table-component>
            </slot>
        </admin-collapsible-sidebar-component>
    </div>

    {!! $chart->script() !!}
@endsection