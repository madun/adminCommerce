@extends('layouts.session')
@section('title', 'Reset Password')

@section('content')
<p class="login-box-msg">Don't worry we have solution for you :)</p>

<form action="{{ route('password.email') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Type here your Email" name="email" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <!-- /.col -->
        <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send My Password</button>
        </div>
        <!-- /.col -->
    </div>
</form>

@endsection
