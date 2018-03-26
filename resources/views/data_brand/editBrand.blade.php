@extends('layouts.master')
@section('title', 'Edit Brand')

@section('style')
@endsection

@section('pageHeader', 'Edit Brand')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('brand.index') }}">Data Brand</li>
    <li class="active">Edit Brand</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Brand : <b>{{ $brand->name }}</b></h3>

        <div class="box-tools pull-right">
            {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>  --}}
        </div>
    </div>
    <div class="box-body">
            <form role="form"class="col-md-6 col-md-offset-3" method="POST" enctype="multipart/form-data" action="{{ route('brand.update', $brand->id) }}">
                {{ csrf_field() }}{{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Brand Name" value="{{ $brand->name }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image Brand</label>
                        <input type="file" id="image" name="image" class="form-control">
        
                        <p class="help-block">* for Resolution 0 x 0 Recomended .</p>
                    </div>
                    <div class="form-group">
                        <label for="">Image Current</label>
                        <div class="col-md-12">
                            <img src="{{ asset($brand->image) }}" width="150" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="javascript:history.back()" class="btn btn-default pull-left">Cancel</a>
                        <button type="submit" class="from-control btn btn-primary pull-right">Save changes</button>
                    </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@endsection
