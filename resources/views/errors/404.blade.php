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
                        <h1>404. Page not found.</h1>
                        <p>The page you are looking for does not exist.</p>

                        <a href="{{ url('/') }}">
                            <i class='fa fa-2x fa-home' style="vertical-align: middle;"></i>
                            <strong>&nbsp; Go Home</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection