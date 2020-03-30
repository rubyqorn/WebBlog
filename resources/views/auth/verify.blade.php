@extends('layouts.app')

@section('content')
    <verify-email-component
        :csrf="{{ json_encode(csrf_token()) }}"
    ></verify-email-component>
@endsection
