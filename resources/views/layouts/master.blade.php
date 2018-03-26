<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin - @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Google Font -->
  {{--  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @section('style')
    @show
</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

  @include('layouts.header')
  
  @include('layouts.side-menu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('pageHeader')
        <small>@yield('smallPageHeader')</small>
      </h1>
      <ol class="breadcrumb">
        @section('breadcrumb')
        @show
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @section('content')
        @show
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.footer')
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@section('script')
@show
</body>
</html>