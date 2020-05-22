@extends('layouts.app')

@section('content')
    <reset-password-component
        :csrf="{{ json_encode(csrf_token()) }}"
        :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
        :token="{{ json_encode($token) }}"
    ></reset-password-component>
@endsection
