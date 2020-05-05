@extends('layouts.app')

@section('content')
    <register-form-component
        :csrf="{{ json_encode(csrf_token()) }}"
    ></register-form-component>
@endsection
