@extends('layout.app-blue')

@section('title')
    404 - AquApp
@endsection

@section('content')
    <div class="text-center">
        <h1>@lang('404. Page not found.')</h1>
        <p>@lang('The page you are looking for does not exist.')</p>
    </div>
@endsection