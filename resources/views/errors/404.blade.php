@extends('layout.app-blue')

@section('title')
    404 - AquApp
@endsection

@section('content')
    <div class="container error">
        <img src="/images/brand-no-back.png" alt="brand" width="200">
        <br>
        <div class="text-center">
            <h1>@lang('404. Page not found.')</h1>
            <p>@lang('The page you are looking for does not exist.')</p>
        </div>
    </div>
@endsection