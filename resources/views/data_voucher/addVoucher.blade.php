@extends('layouts.master')
@section('title', 'Add Voucher')

@section('style')
<link rel="stylesheet" href="{{ asset('bootstrap-daterangepicker/daterangepicker.css') }}">
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
 </style>
@endsection

@section('pageHeader', 'Data Voucher')
@section('smallPageHeader', 'List Of Voucher')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-list"></i> Menu</a></li>
    <li class="{{ route('voucher.index') }}">Data Voucher</li>
    <li class="active">Add Voucher</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Add Voucher</h3>

        <div class="box-tools pull-right">
        </div>
    </div>
    <div class="box-body">
            {{-- <div class="col-md-6 col-md-offset-3">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif
            </div> --}}
            <form role="form" class="col-md-6 col-md-offset-3" method="POST" action="{{ route('voucher.store') }}">
                {{ csrf_field() }}

                    <div class="form-group @if($errors->has('kode')) {{ 'has-error' }} @endif">
                        <label for="">Code Voucher</label>
                        <input type="text" name="kode" id="kode" class="form-control input-lg" maxlength="15" required value="{{ old('kode') }}">
                        <span class="help-block">
                            <b style="color:red">@if($errors->has('kode')) {{ $errors->first('kode') }} @endif</b>
                        </span>
                    </div>
                    <div class="form-group @if($errors->has('daterange')) {{'has-error'}} @endif">
                        <label>Date range</label>
        
                        <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="daterange" name="daterange" placeholder="" value="{{ old('daterange') }}">
                        </div>
                        <span class="help-block">
                            <b style="color:red">@if($errors->has('daterange')) {{ $errors->first('daterange') }} @endif</b>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('discount')) {{'has-error'}} @endif">
                                <label>Discount (%)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="discount" placeholder="10" maxlength="2" value="{{ old('discount') }}">
                                    <div class="input-group-addon">
                                        %
                                    </div>
                                </div>
                                <span class="help-block">
                                    <b style="color:red">@if($errors->has('discount')) {{ $errors->first('discount') }} @endif</b>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="global">Global</option>
                                </select>
                            </div>
                        </div>
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

<script src="{{ asset('moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>
    $('#kondisibarang').select2();
    $('#brand').select2();
    $('#promotion_item').select2();
    // $('#select2').select2({
    //     placeholder: 'Pilih Nama Kategori',
    //     ajax: {
    //         dataType: 'json',
    //         url: "{{ route('api.select.category') }}",
    //         delay: 250,
    //         processResult: function(data) {
    //             return {
    //                 // search: params.term
    //                 result : data
    //             };
    //         },
    //         cache: true
    //     }
    // });

    $('#kode').keyup(function(){
        this.value = this.value.toUpperCase().replace(/\s/g, '');
    });

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

        return true;
    }
    


    $(function() {
        $('#daterange').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            opens: "center",
            autoUpdateInput: false,
        });
        
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD hh:mm:ss') + ' to ' + picker.endDate.format('YYYY-MM-DD hh:mm:ss'));
        });

    });
</script>
@endsection
