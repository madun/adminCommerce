<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brands;

use Yajra\DataTables\Datatables;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data_brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_brand.addBrand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeDatabase = "";
        if($request->hasFile('image')){
            $imageName = rand(1, 10000). time() . '.' . $request->image->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_brands/'. $imageName;
            Image::make($request->image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_brands/') . $imageName);  
        }

        $brand = new Brands;
        $brand->name = $request->name;
        $brand->image = $storeDatabase;
        $brand->save();

        return redirect()->route('brand.index')->with('status', 'Data Brand Has Been Saved');
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
        $brand = Brands::findOrFail($id);
        return view('data_brand.editBrand', ['brand' => $brand]);
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
        $storeDatabase = "";
        $brand = Brands::findOrFail($id);
        $brand->name = $request->name;
        if($request->hasFile('image')){
            $imageName = rand(1, 10000). time() . '.' . $request->image->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_brands/'. $imageName;
            Image::make($request->image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_brands/') . $imageName); 
            $brand->image = $storeDatabase; 
        }        
        $brand->save();

        return redirect()->route('brand.index')->with('status', 'Data Brand Has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Brands::findOrFail($id);

        Brands::destroy($id);
        return redirect()->route('brand.index')->with('status', 'Data Brand Has Been Deleted');
    }

    public function apiBrands(){
        $brands = Brands::all();

        return Datatables::of($brands)
                ->addColumn('image', function($brands){
                    if($brands->image == NULL){
                        return 'No Image';
                    }
                    return '<img class="rounded-square" width="50" height="50" src="'.asset($brands->image).'" alt="">';
                    // return 'ada image';
                })
                ->addColumn('action', function($brands){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("brand/$brands->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$brands->id.'" method="post" action="'.route("brand.destroy", $brands->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$brands->name.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$brands->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';;
                })->rawColumns(['image', 'action'])->make(true);
    }
}
