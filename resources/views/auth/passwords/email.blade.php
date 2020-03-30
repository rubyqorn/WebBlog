@extends('layouts.app')

@section('content')
    <email-confirm-component
        :csrf="{{ jsn_encode(csrf_token()) }}"
    ></email-confirm-component>
@endsection
