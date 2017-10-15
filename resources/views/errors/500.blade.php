@extends('layout.app-blue')

@section('title')
    500 - AquApp
@endsection

@section('content')
    <div class="container error">
        <img src="/images/brand-no-back.png" alt="brand" width="200">
        <br>
        <div class="text-center">
            <h1>@lang('Unexpected failure. Try later.')</h1>
        </div>
    </div>
@endsection