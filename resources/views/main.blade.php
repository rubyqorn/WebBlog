@extends('layouts.main')

    @section('title')
        Главная
    @endsection

    @section('content')
        <div id="app">
            <header-component
                :title="{{ json_encode($title) }}"
            >
            </header-component>

            <hr class="w-75">

            <navbar-component></navbar-component>

            <hr class="w-75">
        </div>
    @endsection
