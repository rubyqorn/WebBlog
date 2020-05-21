@extends('layouts.app')

@section('content')
    <login-form-component
        :csrf="{{ json_encode(csrf_token()) }}"
    ></login-form-component>
@endsection
