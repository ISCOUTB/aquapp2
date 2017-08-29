@extends('layout.app-blue')

@section('title')
    404 - AquApp
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-middle">
                    <img src="/images/brand-no-back.png" alt="brand">
                    <div class="text-center text-center">
                        <h1>@lang('Unexpected failure. Try later.')</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection