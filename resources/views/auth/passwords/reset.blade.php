@extends('layouts.app')

@section('content')
    <reset-password-component
        :csrf="{{ json_encode(csrf_token()) }}"
    ></reset-password-component>
@endsection
