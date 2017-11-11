@extends('layout.app-blue')

@section('title')
    @lang('Login')
@endsection

@section('styles')
    <style>
        .btn-default:hover, .btn-default:active, .btn-default:focus {
            background-color: #fff;
            color: #282e3c;
        }

        @media (min-width: 767px) and (max-width: 991px) {
            img {
                margin: 30px 305px auto;
            }
        }
        @media (min-width: 992px) and (max-width: 1200px) {
            img {
                margin: 30px 428px auto;
            }
        }
        @media (min-width: 1201px) {
            img {
                margin: 30px 528px auto;
            }
        }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-push-3">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-7 col-md-push-3">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-7 col-md-push-3">
                        <input id="password" type="password" class="form-control" name="password" placeholder="@lang('Password')" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember me')
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-7 col-md-offset-3">
                        <button type="submit" class="btn btn-default btn-block">
                            @lang('Login')
                        </button>

                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                        {{--Forgot Your Password?--}}
                        {{--</a>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
