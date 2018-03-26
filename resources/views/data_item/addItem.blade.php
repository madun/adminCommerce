@extends('layouts.master')
@section('title', 'Add Item')

@section('style')
 <!-- Select2 -->
 {{--  <link rel="stylesheet" href="{{ asset('dropzone/dropzone.css') }}">  --}}
 <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
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

@section('pageHeader', 'Data Product')
@section('smallPageHeader', 'List Of Product')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('item.index') }}">Data Item</li>
    <li class="active">Add Item</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Add Item</h3>

        <div class="box-tools pull-right">
            {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>  --}}
        </div>
    </div>
    <div class="box-body">
            <form role="form" data-toggle="validator" class="col-md-6 col-md-offset-3" method="POST" enctype="multipart/form-data" action="{{ route('item.store') }}">
                {{ csrf_field() }}

                    {{--  <div class="form-group">
                        <label for="exampleInputFile">Image Item</label>
                        <input type="file" id="files" name="image_item[]" class="form-control" required multiple>
        
                    </div>  --}}
                    {{--  <div class="form-group preview-image">
                        <label for="exampleInputFile">Preview</label>
                        
                        <div id="list"></div>
                        <p class="help-block pull-right">* for Resolution 0 x 0 Recomended .</p>
                    </div>   --}}
                    <label for="">Image Item</label>
                    <div class="input-group control-group increment" >
                        <input type="file" name="image_item[]" class="form-control">
                        <div class="input-group-btn"> 
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="image_item[]" class="form-control">
                            <div class="input-group-btn"> 
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                            </div>
                        </div>
                    </div>
                    {{--  <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="image_item[]" class="form-control">
                            <div class="input-group-btn"> 
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi Singkat</label>
                        <textarea name="summary" class="form-control" id="" cols="30" rows="6" maxlength="150"></textarea>
                        <p class="help-block pull-right">* Max 150 Char .</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Brand</label>
                        <select class="form-control" style="width: 100%;" id="brand" name="brands_id" required>
                            <option selected="selected" disabled="disabled">Select Brand</option>
                            <option value="1">Brand</option>
                            <option value="2">Brand</option>
                            <option value="3">Brand</option>
                            <option value="4">Brand</option>
                            <option value="5">Brand</option>
                            <option value="6">Brand</option>
                        </select>
                        {{--  <p class="help-block">* Max 150 Char .</p>  --}}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Item</label>
                                <input type="text" class="form-control" name="displayname" placeholder="Enter Name Item" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Item</label>
                                <select class="form-control" style="width: 100%;" id="select2" name="category_id" required>
                                    <option selected="selected" disabled="disabled">Select Category</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Weight (Kg)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="weight" placeholder="Enter Weight" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Promotion Item</label>
                                <select class="form-control" style="width: 100%;" id="promotion_item" name="promotion_item" required>
                                    <option selected="selected" disabled="disabled">Select Promotion Item</option>
                                    <option value="1">User</option>
                                    <option value="2">User</option>
                                    <option value="3">User</option>
                                    <option value="4">User</option>
                                    <option value="5">User</option>
                                    <option value="6">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Price</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                Rp.
                            </div>
                            <input type="text" class="form-control input-lg" id="rupiah" name="price" placeholder="100.000" maxlength="20" required>
                        </div>
                    </div>
                    {{--  <div class="checkbox">
                        <label>
                            <input type="checkbox"> Check me out
                        </label>
                    </div>  --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kondisi Barang</label>
                        <select class="form-control" style="width: 100%;" id="kondisibarang" name="condition" required>
                            {{--  <option selected="selected" disabled="disabled">Select Category</option>  --}}
                            <option value="Baru">Baru</option>
                            <option value="Bekas">Bekas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="additional">Additional Spect</label>
                        {{--  <input type="text" class="form-control" id="additional">  --}}
                        <textarea class="addSpech" name="additionalinfo" required>
                                <table class="table">
                                    <tr>
                                        <td width="100">Weight</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Dimention</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Materials</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Care Tips</td>
                                        <td></td>
                                    </tr>
                                </table>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="desc" name="description" rows="10" cols="80" required>
                                Description Description
                        </textarea>
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

<script src="{{ asset('validator/validator.min.js') }}"></script>

<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>

<script src="{{ asset('WYSIWYG Redactor/redactor.js') }}"></script>

{{--  <script src="{{ asset('dropzone/dropzone.js') }}"></script>  --}}

<script>
    $('#kondisibarang').select2();
    $('#brand').select2();
    $('#promotion_item').select2();
    $('#select2').select2({
        placeholder: 'Pilih Nama Kategori',
        ajax: {
            dataType: 'json',
            url: "{{ route('api.select.category') }}",
            delay: 250,
            processResult: function(data) {
                return {
                    // search: params.term
                    result : data
                };
            },
            cache: true
        }
    });


    $(function() {
        // upload image
        $(".btn-success").click(function(){ 
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".control-group").remove();
        });

        // end upload image

        $('.addSpech').redactor({
            maxHeight: 300,
            minHeight: 120
        });

        $('.desc').redactor({
            imageUpload: '{{ URL::to('upload_img/desc') }}?_token=' + '{{ csrf_token() }}',
            //imageManagerJson:
            plugins: ['alignment', 'imagemanager'],
            maxHeight: 300,
            minHeight: 300
        });

        
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
        

    });
</script>
@endsection
