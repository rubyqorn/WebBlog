<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'WebBlog')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">

    <div id="app">
        @if(Auth::user())
            <common-navbar-component
                :csrf="{{ json_encode(csrf_token()) }}"
                :user="{{ json_encode(Auth::user()->name) }}"
            ></common-navbar-component>
        @else 
            <common-navbar-component></common-navbar-component>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
