@extends('layouts.master')
@section('title', 'Add Banner')

@section('style')
 <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}"> 
<link rel="stylesheet" href="{{ asset('bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
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

@section('pageHeader', 'Add Banner')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li><a href="{{ route('banner.index') }}"> Data Banner</a></li>
    <li class="active">Add Banner</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Banner</h3>
            
                    <div class="box-tools pull-right">
                        {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>  --}}
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" data-toggle="validator" method="POST" class="col-md-6 col-md-offset-3" enctype="multipart/form-data" action="{{ route('banner.store') }}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title Banner</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Parent Category</label>
                                        <select class="form-control" style="width: 100%;" id="select2" name="parent_id">
                                            <option value="">No Parent</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" >{{ $category->displaycategory }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Image Banner</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <p class="help-block">* Recomended Resolution x .</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Banner Untuk</label>
                                    <select class="form-control" style="width: 100%;" id="select" name="for">
                                        <option value="Dashboard" >Dashboard</option>
                                        <option value="Kategori" >Kategori</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Background</label>
                                <input type="text" name="background" id="" class="form-control my-colorpicker1 colorpicker-element" required>
                            </div>
                            <div class="form-group">
                                {{--  <button type="button" onclick="check()" class="btn btn-default pull-left">Close</button>  --}}
                                <input type="checkbox" name="status" checked> <label for="exampleInputEmail1">Publish</label>
                                <button type="submit" class="from-control btn btn-primary pull-right">Save changes</button>
                            </div>
                    </form>
                </div>
            </div>




@endsection

@section('script')

<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script>

    $(function() {
        $('#select2').select2();
        $('#select').select2();

        $('.my-colorpicker1').colorpicker()
    });
</script>
@endsection