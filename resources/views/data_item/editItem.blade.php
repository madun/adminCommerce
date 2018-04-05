@extends('layouts.master')
@section('title', 'Edit Item')

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

 input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  /* border: 2px solid; */
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #F44336;
  /* border: 1px solid black; */
  color: white;
  text-align: center;
  cursor: pointer;
}
 </style>
@endsection

@section('pageHeader', 'Data Product')
@section('smallPageHeader', '')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('item.index') }}">Data Item</li>
    <li class="active">Edit Item</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Item : "<b>{{ $item->displayname }}</b>"</h3>

        <div class="box-tools pull-right">
            {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>  --}}
        </div>
    </div>
    <div class="box-body">
            <form role="form" class="col-md-6 col-md-offset-3" method="POST" enctype="multipart/form-data" action="{{ route('item.update', $item->id) }}">
                {{ csrf_field() }} {{ method_field('PUT') }}

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
                    <div class="input-group" >
                        <input type="file" id="files" name="image_item[]" class="" multiple>
                    </div>
                    
                    <br>
                    <label for="">Current Image</label>
                    <div class="row">
                        
                        @if($item->image_item)
                            @php
                                $myArray = explode(';', $item->image_item);
                                array_pop($myArray); // remove data kosong di akhiir
                                $length = count($myArray);
                                for ($i = 0; $i < $length; $i++) {
                                    echo '<div class="col-md-2"><img class="rounded-square" width="100" src="'.asset($myArray[$i]).'" alt=""></div>';
                                }
                            @endphp
                        @else
                                @php
                                    echo '<div class="col-md-12 text-center">No Image Current Here!</div>';
                                @endphp
                        @endif
                    </div>
                    <br>
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
                        <textarea name="summary" class="form-control" id="summary" cols="30" rows="6" maxlength="150">{{ $item->summary }}</textarea>
                        <p class="help-block pull-right charCount">* Max 150 Char .</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Brand</label>
                        <select class="form-control" style="width: 100%;" id="brand" name="brands_id" required>
                            <option disabled="disabled">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    @if($brand->id == $item->brands_id)
                                        selected="selected"
                                    @endif
                                >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        {{--  <p class="help-block">* Max 150 Char .</p>  --}}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Item</label>
                                <input type="text" class="form-control" name="displayname" placeholder="Enter Name Item" value="{{ $item->displayname }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Item</label>
                                <select class="form-control" style="width: 100%;" id="category" name="category_id" required>
                                    <option disabled="disabled">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($category->id == $item->category_id)
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
                                <label for="exampleInputEmail1">Weight (Kg)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="weight" placeholder="Enter Weight" value="{{ $item->weight }}" required>
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
                            <input type="text" class="form-control input-lg" id="rupiah" name="price" placeholder="100.000" maxlength="20" value="{{ $item->price }}" required>
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
                            <option value="Baru"
                            @if($item->condition == 'Baru')
                                selected="selected"
                            @endif
                            >Baru</option>
                            <option value="Bekas"
                            @if($item->condition == 'Bekas')
                                selected="selected"
                            @endif
                            >Bekas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="additional">Additional Spect</label>
                        {{--  <input type="text" class="form-control" id="additional">  --}}
                        <textarea class="addSpech" name="additionalinfo" required>{{ $item->additionalinfo }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="desc" name="description" rows="10" cols="80" required>{{ $item->description }}</textarea>
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
    $('#category').select2();


    $(function() {
        $('#summary').keyup(updateCount);
        $('#summary').keydown(updateCount);

        function updateCount() {
            var cs = $(this).val().length;
            $('.charCount').text(cs);
        }
        // upload image
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove</span>" +
                    "</span>").insertAfter("#files");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });
                
                // Old code here
                /*$("<img></img>", {
                    class: "imageThumb",
                    src: e.target.result,
                    title: file.name + " | Click to remove"
                }).insertAfter("#files").click(function(){$(this).remove();});*/
                
                });
                fileReader.readAsDataURL(f);
            }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }

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
