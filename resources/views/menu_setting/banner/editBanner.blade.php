@extends('layouts.master')
@section('title', 'Edit Banner')

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

@section('pageHeader', 'Edit Banner')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li><a href="{{ route('banner.index') }}"> Data Banner</a></li>
    <li class="active">Edit Banner</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Banner : <b>{{ $banner->title }}</b></h3>
            
                    <div class="box-tools pull-right">
                        {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>  --}}
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" data-toggle="validator" method="POST" class="col-md-6 col-md-offset-3" enctype="multipart/form-data" action="{{ route('banner.update', $banner->id) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title Banner</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $banner->title }}" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Parent Category</label>
                                        <select class="form-control" style="width: 100%;" id="select2" name="parent_id">
                                            <option value="">No Parent</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if($category->id == $banner->parent_id)
                                                        selected="selected"
                                                    @endif
                                                >{{ $category->displaycategory }}</option>
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
                                        
                                            <option value="Dashboard" 
                                                @if($banner->for == 'Dashboard')
                                                selected
                                                @endif
                                            >Dashboard</option>
                                        <option value="Kategori"
                                            @if($banner->for == 'Kategori')
                                            selected
                                            @endif
                                        >Kategori</option>
                                    </select>
                                </div>
                            </div>
                            <label for="">Current Image</label>
                            <div class="row">
                                
                                @if($banner->image)
                                    @php
                                        echo '<div class="col-md-2"><img class="rounded-square" width="100" src="'.asset($banner->image).'" alt=""></div>';
                                    @endphp
                                @else
                                    @php
                                        echo '<div class="col-md-12 text-center">No Image Current Here!</div>';
                                    @endphp
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="">Background</label>
                                <input type="text" name="background" id="" class="form-control my-colorpicker1 colorpicker-element" value="{{ $banner->background }}" required>
                            </div>
                            <div class="form-group">
                                {{--  <button type="button" onclick="check()" class="btn btn-default pull-left">Close</button>  --}}
                                <input type="checkbox" name="status" @if($banner->status) checked @endif> <label for="exampleInputEmail1">Publish</label>
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