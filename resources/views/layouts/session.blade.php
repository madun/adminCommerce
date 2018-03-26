<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/fontawesome/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>E</b>Commerce</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    
    @section('content')
    @show

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

{{--  @section('script')  --}}
<script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
        });
    });
</script>
{{--  @endsection  --}}
</body>
</html>


