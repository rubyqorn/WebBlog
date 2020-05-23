@extends('layouts.admin')

@section('content')
    <div id="dashboard">
        <admin-navbar-component
            :csrf="{{ json_encode(csrf_token()) }}"
            :user="{{ json_encode(Auth::user()->name) }}"
        ></admin-navbar-component>

        <admin-collapsible-sidebar-component></admin-collapsible-sidebar-component>
            
    </div>
@endsection 
