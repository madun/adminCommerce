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

.addimage{
    width: 100px;
    height: 100px;
    background: #eaeaea;
    cursor: pointer;
    border-radius: 5px;
}

.addimage-mrg{
    margin: 34px;
}

.addimage:hover{
    background: #f2f2f2;
    color: #0b9a48;
}

.addimage:hover > .removeimage-mrg{
    display: block !important;
}

.removeimage-mrg{
    margin: 34px;
    display: none !important;
}

.removeimage:hover{
    background: #f2f2f2;
    color: #0b9a48;
    display: block;
}

#addimageall{
    width: 80px;
    padding: 4px;
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
            <form id="formaddproduct" role="form" data-toggle="validator" class="col-md-6 col-md-offset-3" method="POST" enctype="multipart/form-data" action="{{ route('item.store') }}">
                {{ csrf_field() }}

                    <label for="">Image Item</label>
                    <div class="input-group" >
                        <table>
                            <tbody>
                                <tr id="addimageall">
                                    <td id="bbgforplace">
                                        <input type="file" name="contoh" id="brgcontoh" class="hidden">
                                        <!--background-image: url(http://localhost/gemstone-web/foto_profile/3.jpeg);-->
                                        <div id="bbgforadd" onclick="javascript:document.getElementById('brgcontoh').click();" class="addimage" style="float: left;background-size: cover;background-repeat: no-repeat;background-position: center center;">
                                            <!--<img id="bgt" class='thumbnails' style="max-height: 100px !important; max-width: 100px !important; border-radius: 5px;" src="">-->
                                            <i class="fa-stack fa-lg addimage-mrg">
                                                <i class="fa fa-plus-circle fa-stack-2x"></i>
                                                <!--<i class="fa fa-circle-thin fa-stack-2x"></i>-->
                                            </i>
                                        </div>
                                    </td>
                                    <td id="placeforfotobarang"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi Singkat</label>
                        <textarea name="summary" class="form-control" id="" cols="30" rows="6" maxlength="150"></textarea>
                        <p class="help-block pull-right">* Max 150 Char .</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Brand</label>
                        <select class="form-control" style="width: 100%;" id="brand" name="brands_id" required>
                            <option disabled="disabled">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
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
                        <input type="submit" class="from-control btn btn-primary pull-right" value="Save changes">
                        {{-- <input onclick="simpanaddbarang()" type="button" class="from-control btn btn-primary pull-right" value="Save changes"> --}}
                    </div>
        </form>
    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('validator/validator.min.js') }}"></script>

<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>

<script src="{{ asset('WYSIWYG Redactor/redactor.js') }}"></script>
<script src="{{ asset('js/validationImage.js') }}"></script>

{{--  <script src="{{ asset('dropzone/dropzone.js') }}"></script>  --}}

<script>
    $(document).ready(function(){
        function readImageNoReload(input, brgid) {
            if ( input.files && input.files[0] ) {
                var FR= new FileReader();
                FR.onload = function(e) {
                    $("#bbgforplace").append('<div id="bgrid'+brgid+'" onclick="javascript:brgidremove(this,'+brgid+')" class="addimage" style="float:left;margin-left: 10px;background-size: cover;background-repeat: no-repeat;background-position: center center; background-image: url('+e.target.result+')" dataforthis="'+e.target.result+'">'+
                                            '<i class="fa-stack fa-lg removeimage-mrg">'+
                                            '<i class="fa fa-times-circle fa-stack-2x"></i></i></div>');
                    // $("#placeforfotobarang").append('<input type="file" name="barangfoto[]" id="brg'+brgid+'" class="hidden barangfoto" value="'+e.target.result+'">');
                    var idsaja = $(this).attr("id");
                    var nilai = $(this).attr("dataforthis");
                    if(idsaja!="bbgforadd"){
                        $("#placeforfotobarang").append('<input id="image_item'+brgid+'" type="file" name="image_item[]" class="hidden barangfoto" value="'+nilai+'">');
                    }
                    
                    if(brgid==5){
                        $("#bbgforadd").hide();
                    } else {
                        $("#bbgforadd").show();
                    }
                };       
                FR.readAsDataURL( input.files[0] );
            }
        }
        $("#brgcontoh").change(function(){
            var bgridnumber = $("#bbgforplace").find(".addimage").length;
            readImageNoReload( this, bgridnumber );
        });
    });


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

    function brgidremove(thisin,brgid){
        $(thisin).remove();
        $('#image_item'+brgid+'').remove();
        $('#bbgforadd').show();
    }
    
    // function simpanaddbarang(){
    //     $("#bbgforplace").find(".addimage").each(function(){
    //         var idsaja = $(this).attr("id");
    //         var nilai = $(this).attr("dataforthis");
    //         if(idsaja!="bbgforadd"){
    //             $("#placeforfotobarang").append('<input type="file" name="image_item[]" class="hidden barangfoto" value="'+nilai+'">');
    //         }
    //     });

    //     $("#formaddproduct").submit();
    // // var length = $("#placeforfotobarang").find(".barangfoto").length;
    // // alert(length);
    // }
    
    $("#formaddproduct").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
//                console.log($("#placeforfotobarang").find(".barangfoto").length);
        if($("#placeforfotobarang").find(".barangfoto").length>0){
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function(data, textStatus, jqXHR)
                {
                    console.log(data);
//                     if (typeof parseInt(data) == 'number') {
//                         var nilaifoto = new Array();
//                         var it=0;
//                         $("#placeforfotobarang").find(".barangfoto").each(function(){
//                             nilaifoto[it] = $(this).attr("value");
// //                                console.log(nilaifoto[it]);
//                             it++;
//                         });

//                         $.post('http://gemstone.epizy.com/store/upload_foto_barang',{
//                             id_item : data,
//                             foto : nilaifoto
//                         });

//                         $('#formaddproduct').each(function() {
//                             this.reset();
//                         });
//                         alert("Barang anda telah tersimpan.");
//                         window.location.replace("http://gemstone.epizy.com/store/myproduct");
//                     } else {
//                         $('#validation-error-addproduct').show();
//                         $('#validation-error-addproduct').html(data);
//                         $(window).scrollTop(0);
//                     }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $('#validation-error-addproduct').show();
                    $('#validation-error-addproduct').html(jqXHR.msg);
                }
            });
        } else {
            $('#validation-error-addproduct').show();
            $('#validation-error-addproduct').html('<p>Kolom Foto Barang minimal 1 Foto.</p>');
            $(window).scrollTop(0);
        }
        e.preventDefault();	//STOP default action
    });
    
</script>
@endsection
