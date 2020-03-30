@extends('layouts.app')

@section('content')
    <confirm-password-component
        :csrf="{{ json_encode(csrf_token()) }}"
    ></confirm-password-component>
@endsection
