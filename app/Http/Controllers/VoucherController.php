<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('data_voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_voucher.addVoucher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'unique:voucher',
        ]);

        // daterange explode
        $myArray = explode('to', $request->daterange);
        $removeSpace = array_map('trim',array_filter($myArray)); // remove space

        $voucher = new Voucher;
        $voucher->kode = $request->kode;
        $voucher->start_date = $removeSpace[0];
        $voucher->end_date = $removeSpace[1];
        $voucher->discount = $request->discount;
        $voucher->status = 1;
        $voucher->level = $request->level;
        // return $voucher;
        $voucher->save();

        return redirect()->route('voucher.index')->with('status', 'Data Voucher Has Been Added!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('data_voucher.editVoucher', ['voucher' => $voucher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'unique:voucher',
        ]);

        // daterange explode
        $myArray = explode('to', $request->daterange);
        $removeSpace = array_map('trim',array_filter($myArray)); // remove space

        $voucher = Voucher::findOrFail($id);
        $voucher->kode = $request->kode;
        $voucher->start_date = $removeSpace[0];
        $voucher->end_date = $removeSpace[1];
        $voucher->discount = $request->discount;
        $voucher->status = 1;
        $voucher->level = $request->level;
        // return $voucher;
        $voucher->save();

        return redirect()->route('voucher.index')->with('status', 'Data Voucher Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voucher::destroy($id);
        return redirect()->route('voucher.index')->with('status', 'Data Voucher Has Been Deleted');
    }

    public function apiVoucher(){
        $voucher = Voucher::select('id', 'kode', 'start_date', 'end_date', 'discount', 'status', 'level');

        return Datatables::of($voucher)
                ->addColumn('kode', function($voucher){
                    return '<b>'.$voucher->kode.'</b>';
                })
                ->addColumn('action', function($voucher){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("voucher/$voucher->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$voucher->id.'" method="post" action="'.route("voucher.destroy",$voucher->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$voucher->displayname.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$voucher->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })->rawColumns(['kode', 'action'])->make(true);
    }
}
