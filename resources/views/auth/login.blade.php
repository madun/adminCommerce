@extends('layouts.session')
@section('title', 'Login')

@section('content')
<p class="login-box-msg">Sign in to start your session</p>

<form action="{{ route('login') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    </div>
    <div class="form-group has-feedback">
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    </div>
    <div class="row">
    <div class="col-xs-8">
        <div class="checkbox icheck">
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <!-- /.col -->
    </div>
</form>

{{--  <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
    Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
    Google+</a>
</div>  --}}
<!-- /.social-auth-links -->

<a href="{{ route('password.request') }}">I forgot my password</a><br>
@endsection