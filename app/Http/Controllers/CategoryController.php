<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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
        return view('data_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('data_category.addCategory', ['categories' => $categories]);
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
        if($request->hasFile('imagecategory')){
            $imageName = rand(1, 10000). time() . '.' . $request->imagecategory->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_category/'. $imageName;
            Image::make($request->imagecategory->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_category/') . $imageName);  
        }

        $category = new Category;
        $category->displaycategory = $request->displaycategory;
        $category->imagecategory = $storeDatabase;
        $category->parent_id = $request->parent_id;
        $category->icon = "fa ".$request->icon;
        $category->direct = $request->direct;
        $category->save();

        return redirect()->route('category.index')->with('status', 'Data Category Has Been Saved');
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
        $getData = Category::find($id);
        $dataAll = Category::all();
        return view('data_category.editCategory', ['dataAll' => $dataAll, 'getData' => $getData]);
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
        $category = Category::findOrFail($id);
        if($request->hasFile('imagecategory')){
            $imageName = rand(1, 10000). time() . '.' . $request->imagecategory->getClientOriginalExtension();
            $storeDatabase = 'storage/upload/image_category/'. $imageName;
            Image::make($request->imagecategory->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_category/') . $imageName);  
            $category->imagecategory = $storeDatabase;
        }

        $category->displaycategory = $request->displaycategory;
        $category->parent_id = $request->parent_id;
        $category->icon = "fa ".$request->icon;
        $category->direct = $request->direct;
        $category->save();

        return redirect()->route('category.index')->with('status', 'Data Category Has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        // $myArray = explode(';', $item->image_item);
        // array_pop($myArray); // remove data kosong di akhiir
        // $length = count($myArray);
        // Storage::delete($myArray);

        Category::destroy($id);
        return redirect()->route('category.index')->with('status', 'Data Category Has Been Deleted');
    }

    public function apiCategory(){
        $category = Category::all();

        return Datatables::of($category)
                ->addColumn('icon', function($category){
                    if($category->icon == NULL){
                        return 'No Icon';
                    }
                    return '<i class="'.$category->icon.'"></i>';
                })
                ->addColumn('imagecategory', function($category){
                    if($category->imagecategory == NULL){
                        return 'No Image';
                    }
                    return '<img class="rounded-square" width="50" height="50" src="'.asset($category->imagecategory).'" alt="">';
                    // return 'ada image';
                })
                ->addColumn('action', function($category){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("category/$category->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$category->id.'" method="post" action="'.route("category.destroy",$category->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$category->displaycategory.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$category->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';;
                })->rawColumns(['icon', 'imagecategory', 'action'])->make(true);
    }

    public function apiForSelect(){
        $category = Category::all();
        $json = [];
        foreach($category as $cat){
            $json[] = ['id'=>$cat['id'], 'text'=>$cat['displaycategory']];
        }
        return response()->json([
            "results" => $json
        ]);
    }
}
