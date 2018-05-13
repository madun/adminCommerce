@extends('layouts.master')
@section('title', 'Mail Template')

@section('style')
<link rel="stylesheet" href="{{ asset('datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('pageHeader', 'Data Mail Template')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li><a href="#"> Setting</a></li>
    <li class="active">Data Mail Management</li>
@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <a href="{{ route('mail.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i> Add Mail Template</a>
        </div>
    </div>
    <div class="box-body">
        <table id="mail-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="30">No.</th>
                <th>Template Name</th>
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
    // $(function() {
    //     $.ajax({
    //         type:'get',
    //         url:"{{ route('api.banner') }}",
    //         success: function(data){
    //             console.log(data)
    //         }
    //     });
    // }); 
    var table = $('#mail-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax : "{{ route('api.mailTemplate') }}",
                    'columnDefs': [
                    {
                        "targets": 0, // your case first column
                        "className": "text-center",
                        "width": "50",
                    },
                    {
                        "targets": 2, // your case first column
                        "className": "text-center",
                        "width": "130",
                    }],
                    columns: [
                        {data:'id', name:'id'},
                        {data:'template_name', name:'template_name'},
                        {data:'action', name:'action', orderable: false, searchable: false}
                    ]
                });
   
</script>
@endsection
