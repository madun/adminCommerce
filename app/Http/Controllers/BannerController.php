<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use Yajra\DataTables\Datatables;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu_setting.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('menu_setting.banner.addBanner', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $banner = new Banner;
        $banner->title = $request->title;
        $banner->parent_id = $request->parent_id;
        $banner->for = $request->for;
        $banner->background = $request->background;
        if($request->status){
            $banner->status = "published";
        }
        $storeDatabase = "";
        if($request->hasFile('image')){
            $imageName = rand(1, 10000). time() . '.' . $request->image->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_banner/'. $imageName;
            Image::make($request->image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_banner/') . $imageName); 
            $banner->image = $storeDatabase; 
        }
        $banner->save();
        return redirect()->route('banner.index')->with('status', 'Data Banned Has Been Saved');
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
        $banner = Banner::findOrFail($id);
        $categories = Category::all();
        return view('menu_setting.banner.editBanner', ['banner' => $banner, 'categories' => $categories]);
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
        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->parent_id = $request->parent_id;
        $banner->for = $request->for;
        $banner->background = $request->background;
        if($request->status){
            $banner->status = "published";
        }
        $storeDatabase = "";
        if($request->hasFile('image')){
            $imageName = rand(1, 10000). time() . '.' . $request->image->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_banner/'. $imageName;
            Image::make($request->image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_banner/') . $imageName); 
            $banner->image = $storeDatabase; 
        }
        $banner->save();
        return redirect()->route('banner.index')->with('status', 'Data Banner Has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Banner::findOrFail($id);

        Banner::destroy($id);
        return redirect()->route('banner.index')->with('status', 'Data Banner Has Been Deleted');
    }

    public function apiBanner(){
        $banner = Banner::all();
        // return $banner;
        return Datatables::of($banner)
                ->addColumn('image', function($banner){
                    if($banner->image == NULL){
                        return 'No Image';
                    }
                    return '<img class="rounded-square" width="50" height="50" src="'.asset($banner->image).'" alt="">';
                    // return 'ada image';
                })
                ->addColumn('action', function($banner){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("banner/$banner->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$banner->id.'" method="post" action="'.route("banner.destroy", $banner->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$banner->title.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$banner->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';;
                })->rawColumns(['image', 'action'])->make(true);
    }
}
