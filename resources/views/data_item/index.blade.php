@extends('layouts.master')
@section('title', 'Product')

@section('style')
<link rel="stylesheet" href="{{ asset('datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('pageHeader', 'Data Product')
@section('smallPageHeader', 'List Of Product')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="active">Data Item</li>
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
            <a href="{{ route('item.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i> Add Item</a>
        </div>
    </div>
    <div class="box-body">
        <table id="item-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="30">No.</th>
                <th>Name</th>
                <th>Category</th>
                <th>Count View</th>
                <th>Weight</th>
                <th>Price</th>
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
                    ajax : "{{ route('api.item') }}",
                    'columnDefs': [
                    {
                        "targets": 7, // your case first column
                        "className": "text-center",
                        "width": "130",
                    },
                    {
                        "targets": 6, // your case first column
                        "className": "text-center",
                    },
                    {
                        "targets": 5, // your case first column
                        "className": "text-right",
                    },
                    {
                        "targets": 4, // your case first column
                        "className": "text-center",
                        "width": "20",
                    },
                    {
                        "targets": 3, // your case first column
                        "className": "text-center",
                        "width": "100",
                    },
                    {
                        "targets": 2, // your case first column
                        "className": "text-center",
                        "width": "110",
                    }],
                    columns: [
                        {data:'id', name:'id'},
                        {data:'displayname', name:'displayname'},
                        {data:'category_id', name:'category_id'},
                        {data:'count_view', name:'count_view'},
                        {data:'weight', name:'weight'},
                        {data:'price', name:'price'},
                        {data:'image_item', name:'image_item', searchable: false},
                        {data:'action', name:'action', orderable: false, searchable: false}
                    ]
                });

    // $(function() {

        
    //     var tanpa_rupiah = document.getElementById('rupiah');
    //     tanpa_rupiah.addEventListener('keyup', function(e)
    //     {
    //         tanpa_rupiah.value = formatRupiah(this.value);
    //     });
        
    //     /* Fungsi */
    //     function formatRupiah(angka, prefix)
    //     {
    //         var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //             split	= number_string.split(','),
    //             sisa 	= split[0].length % 3,
    //             rupiah 	= split[0].substr(0, sisa),
    //             ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
                
    //         if (ribuan) {
    //             separator = sisa ? '.' : '';
    //             rupiah += separator + ribuan.join('.');
    //         }
            
    //         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //         return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    //     }
    //     // $('.textarea').wysihtml5()
    //     CKEDITOR.replace('editor1');
    //     CKEDITOR.replace('editor2');

    // });

    
</script>
@endsection
