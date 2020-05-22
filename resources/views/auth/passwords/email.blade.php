@extends('layouts.app')

@section('content')
    <email-confirm-component
        :csrf="{{ json_encode(csrf_token()) }}"
        :errors="{{ json_encode($errors->any() ? $errors->all() : null) }}"
    ></email-confirm-component>
@endsection
