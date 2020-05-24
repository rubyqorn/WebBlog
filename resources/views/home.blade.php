@extends('layouts.admin')

@section('content')
    <div id="dashboard">
        <admin-navbar-component
            :csrf="{{ json_encode(csrf_token()) }}"
            :user="{{ json_encode(Auth::user()->name) }}"
        ></admin-navbar-component>

        <admin-collapsible-sidebar-component>
            <slot name="header">

                <div class="row mt-4">
                    <div class="col-lg-5 ml-4 bg-white shadow p-4 rounded">
                        
                    </div>
                    <div class="col-lg-5 ml-4 bg-white shadow p-4 rounded">
                        
                    </div>
                </div>

            </slot>
        </admin-collapsible-sidebar-component>
            
    </div>
@endsection 
