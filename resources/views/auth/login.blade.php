@extends('layout.app-blue')

@section('title')
    @lang('Login')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4 container-box">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control input-lg" name="password" placeholder="@lang('Password')" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember me')
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block btn-lg">
                        @lang('Login')
                    </button>

                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                    {{--Forgot Your Password?--}}
                    {{--</a>--}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
