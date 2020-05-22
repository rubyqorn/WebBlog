@extends('layouts.app')

@section('content')
    <confirm-password-component
        :csrf="{{ json_encode(csrf_token()) }}"
        :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
    ></confirm-password-component>
@endsection
