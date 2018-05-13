@extends('layouts.master')
@section('title', 'Edit Template Mail')

@section('style')
 <!-- Select2 -->
 {{-- <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">  --}}
 <link rel="stylesheet" href="{{ asset('WYSIWYG Redactor/redactor.css') }}">
 <style>
 .select2-container--default .select2-selection--single {
    /* border: 0.5px solid grey;  */
    display: block;
    width: 100%;
    height: 36px;
    padding: 6px 12px !important;
    font-size: 14px !important;
    line-height: 1.6 !important;
    color: #555555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccd0d2;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
 }
 </style>
@endsection

{{-- @section('pageHeader', 'Edit Template Mail') --}}
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li><a href="{{ route('mail.index') }}"> Data Template Mail</a></li>
    <li class="active">Edit Template Mail</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Template Mail : <b>{{ $mail->template_name }}</b></h3>
            
                    <div class="box-tools pull-right">
                        {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>  --}}
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" data-toggle="validator" method="POST" class="col-md-6 col-md-offset-3" enctype="multipart/form-data" action="{{ route('mail.update', $mail->id) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Subject</label>
                                <input type="text" class="form-control" name="template_name" placeholder="Enter Subject" autofocus required value="{{ $mail->template_name }}">
                            </div>
                            <div class="form-group">
                                <label for="desc">Body</label>
                                <textarea class="desc" name="template" rows="10" cols="80" required>{{ $mail->template }}</textarea>
                            </div>
                            <div class="form-group">
                                {{--  <button type="button" onclick="check()" class="btn btn-default pull-left">Close</button>  --}}
                                {{-- <input type="checkbox" name="status" checked> <label for="exampleInputEmail1">Publish</label> --}}
                                <button type="submit" class="from-control btn btn-primary pull-right">Save changes</button>
                            </div>
                    </form>
                </div>
            </div>




@endsection

@section('script')

{{-- <script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script> --}}
<script src="{{ asset('WYSIWYG Redactor/redactor.js') }}"></script>
<script>

    $(function() {
        // $('#select2').select2();
        // $('#select').select2();

        $('.desc').redactor({
            imageUpload: '{{ URL::to('mail_image/desc') }}?_token=' + '{{ csrf_token() }}',
            //imageManagerJson:
            plugins: ['alignment', 'imagemanager'],
            maxHeight: 300,
            minHeight: 600
        });
    });
</script>
@endsection