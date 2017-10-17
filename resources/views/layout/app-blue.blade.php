<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400|Crimson+Text' rel='stylesheet' type='text/css'>
    <!-- Normalize -->
    <link type="text/css" href="/css/normalize.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="/libs/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Theme Style -->
    <link href="/display-template/css/style.css" rel="stylesheet">

    <link href="/css/general.css" rel="stylesheet">

    <link href="/css/app-blue.css" rel="stylesheet">

    @yield('styles')
</head>
<body>

<nav class="navbar navbar-light">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> &nbsp; @lang('Home') </a></li>
        <li><a href="{{ url('about') }}"><i class="fa fa-question-circle" aria-hidden="true"></i> &nbsp; @lang('About') </a></li>
    </ul>
</nav>

@yield('content')

<footer class="footer">
    <small class="text">Copyright © 2017. Universidad Tecnologica de Bolivar.</small>
</footer>

<!-- Jquery -->
<script src="/libs/jquery/jquery-1.12.4.min.js"></script>
<!-- Bootstrap -->
<script src="/libs/bootstrap-3.3.7/js/bootstrap.min.js"></script>

@yield('scripts')
</body>
</html>
