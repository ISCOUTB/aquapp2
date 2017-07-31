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
    <!-- Theme Style -->
    <link href="/display-template/css/style.css" rel="stylesheet">

    <link href="/css/general.css" rel="stylesheet">

    @yield('styles')
</head>
<body class="inner-page">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand" href="#">
                    <img alt="Brand" src="/images/brand.png">
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0)"> @lang('Login') </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Config::get('locale')[App::getLocale()] }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach (Config::get('locale') as $key => $locale)
                                @if ($key != App::getLocale())
                                    <li><a href="{{ route('locale', $key) }}">{{ $locale }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)"><i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i> @lang('Help') </a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    @yield('content')

    <footer class="footer">
        <small>&copy; 2017. Universidad Tecnologica de Bolivar - Cartagena de Indias, Colombia</small>
    </footer>

    <!-- Jquery -->
    <script src="/libs/jquery/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="/libs/bootstrap-3.3.7/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>
