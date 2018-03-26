@extends('layouts.master')
@section('title', 'Edit Category')

@section('style')
 <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
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

@section('pageHeader', 'Edit Category')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('category.index') }}">Data Category</li>
    <li class="active">Edit Category</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-4 fixed">
        <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Category : <b>{{ $getData->displaycategory }}</b></h3>
            
                    <div class="box-tools pull-right">
                        {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>  --}}
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" data-toggle="validator" method="POST" enctype="multipart/form-data" action="{{ route('category.update', $getData->id) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name Category</label>
                                    <input type="text" class="form-control" name="displaycategory" placeholder="Enter Name Category" value="{{ $getData->displaycategory }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Parent Category</label>
                                        <select class="form-control" style="width: 100%;" id="select2" name="parent_id">
                                            <option value="">No Parent</option>
                                            @foreach($dataAll as $data)
                                                <option value="{{ $data->id }}"
                                                    @if($data->id == $getData->parent_id)
                                                        selected="selected"
                                                    @endif
                                                >{{ $data->displaycategory }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Image Category</label>
                                        <input type="file" name="imagecategory" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Icone Category</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="{{ $getData->icon }}"></i>
                                            </div>
                                            <input type="text" class="form-control" id="icon" name="icon" placeholder="" value="{{ str_replace('fa ','',$getData->icon) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <label for="">Current Image</label>
                            <div class="row">
                                <div class="col-md-12"><img class="rounded-square" src="{{ url($getData->imagecategory) }}" alt="" width="100"></div>
                            </div>    
                            <br>
                            <div class="form-group">
                                <label for="">Direct</label>
                                <input type="text" name="direct" id="" value="{{ $getData->direct }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <a href="javascript:history.back()" class="btn btn-default pull-left">Cancel</a>
                                <button type="submit" class="from-control btn btn-primary pull-right">Save changes</button>
                            </div>
                    </form>
                </div>
            </div>
    </div>

    <div class="col-md-8">
        <!-- Font Awesome Icons -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Icon</h3>
        
                <div class="box-tools pull-right">
                    {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>  --}}
                </div>
            </div>
            <div class="box-body">
                @include('fontawesome')
            </div>
        </div>
    </div>

</div>



@endsection

@section('script')

<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script>

    $(function() {

        $('#select2').select2();

        
        var tanpa_rupiah = document.getElementById('rupiah');
        tanpa_rupiah.addEventListener('keyup', function(e)
        {
            tanpa_rupiah.value = formatRupiah(this.value);
        });
        
        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split	= number_string.split(','),
                sisa 	= split[0].length % 3,
                rupiah 	= split[0].substr(0, sisa),
                ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        // $('.textarea').wysihtml5()
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

    });
</script>
@endsection