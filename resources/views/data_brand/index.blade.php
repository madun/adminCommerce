@extends('layouts.master')
@section('title', 'Brand')

@section('style')
<link rel="stylesheet" href="{{ asset('datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('pageHeader', 'Data Brand')
@section('smallPageHeader', 'List Of Product')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="active">Data Brands</li>
@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
{{--  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Alert!</h4>
    Success alert preview. This alert is dismissable.
</div>  --}}
@if (session('status'))
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        <strong>{{ session('status') }}</strong>
        </div>
    </div>
</div>
@endif
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">All Data</h3>

        <div class="box-tools pull-right">
            {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>  --}}
            <a href="{{ route('brand.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i> Add Brand</a>
        </div>
    </div>
    <div class="box-body">
        <table id="item-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="30">No.</th>
                <th>Name</th>
                <th>Image</th>
                <th width="190">Action</th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
    </div>
    <!-- /.box-body -->
    {{--  <div class="box-footer">
    Footer
    </div>  --}}
    <!-- /.box-footer-->
</div>
@endsection

@section('script')
<script src="{{ asset('datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>
    var table = $('#item-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax : "{{ route('api.brands') }}",
                    'columnDefs': [
                    {
                        "targets": 3, // your case first column
                        "className": "text-center",
                        "width": "120",
                    },
                    {
                        "targets": 2, // your case first column
                        "className": "text-center",
                        "width": "110",
                    }],
                    columns: [
                        {data:'id', name:'id'},
                        {data:'name', name:'name'},
                        {data:'image', name:'image', searchable: false},
                        {data:'action', name:'action', orderable: false, searchable: false}
                    ]
                });

    
</script>
@endsection
