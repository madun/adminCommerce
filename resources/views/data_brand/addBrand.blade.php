@extends('layouts.master')
@section('title', 'Add Brand')

@section('style')
@endsection

@section('pageHeader', 'Data Brand')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('brand.index') }}">Data Brand</li>
    <li class="active">Add Brand</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Add Brand</h3>

        <div class="box-tools pull-right">
            {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>  --}}
        </div>
    </div>
    <div class="box-body">
            <form role="form"class="col-md-6 col-md-offset-3" method="POST" enctype="multipart/form-data" action="{{ route('brand.store') }}">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Brand Name" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image Brand</label>
                        <input type="file" id="image" name="image" class="form-control" required>
        
                        <p class="help-block">* for Resolution 0 x 0 Recomended .</p>
                    </div>
                    <div class="form-group">
                        {{--  <button type="button" onclick="check()" class="btn btn-default pull-left">Close</button>  --}}
                        <button type="submit" class="from-control btn btn-primary pull-right">Save changes</button>
                    </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@endsection
