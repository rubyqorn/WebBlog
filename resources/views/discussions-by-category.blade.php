@extends('layouts.main')

@section('title')
    Discussions by category 
@endsection

@section('content')
    <div id="discussions">

        @if(Auth::user())
            <common-navbar-component
                :usercontent="{{ json_encode([
                    'user' => Auth::user()->name,
                    'csrfToken' => csrf_token()
                ]) }}"
            ></common-navbar-component>
        @endif

        <common-navbar-component></common-navbar-component>

        <div class="container mt-4" id="discussions-by-category">
            <div class="row justify-content-center">

                <discussions-categories-component
                    :categories="{{ json_encode($categories) }}"
                ></discussions-categories-component>

                <discussions-by-category-component
                    :discussions="{{ json_encode($discussions) }}"
                ></discussions-by-category-component>
            </div>
        </div>

        <footer-component></footer-component>

    </div>
@endsection