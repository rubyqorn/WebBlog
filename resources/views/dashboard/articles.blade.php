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
                <div class="col-lg-12 rounded shadow bg-white mt-4 p-4 mb-4">
                    {!! $chart->container() !!}
                </div>

                <articles-table-component>
                    <slot>
                        <search-articles-form-component
                            :csrf="{{ json_encode(csrf_token()) }}"
                        ></search-articles-form-component>
                    </slot>
                </articles-table-component>
            </slot>

        </admin-collapsible-sidebar-component>
    </div>

    {!! $chart->script() !!}
@endsection