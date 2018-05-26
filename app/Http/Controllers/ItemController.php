<?php

namespace App\Http\Controllers;

use App\Item;
use App\Brands;
use App\Category;
use Yajra\DataTables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
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
        // $item = Item::all();
        return view('data_item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brands::all();
        $categories = Category::all();
        return view('data_item.addItem', ['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;

        // $dataImage = "";
        // if($request->hasfile('image_item'))
        //  {
        //     foreach($request->file('image_item') as $image)
        //     {
        //         $imageName = rand(1, 10000). time() . '.' . $image->getClientOriginalExtension();
        //         // $imageName =  rand(1, 10000). 'Madun.' . $image->getClientOriginalExtension();
        //         $storeDatabase = 'storage/upload/image_item/'. $imageName;
        //         Image::make($image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_item/') . $imageName);  
        //         $dataImage .= $storeDatabase.';';  
        //     }
        //  }
        
        // //  return $dataImage;

        // $item = new Item;
        // $item->displayname = $request->displayname;
        // $item->category_id = $request->category_id;
        // $item->weight = $request->weight;
        // $item->promotion_item = $request->promotion_item;
        // $item->price = str_replace(".","",$request->price);
        // $item->additionalinfo = $request->additionalinfo;
        // $item->description = $request->description;
        // $item->image_item = $dataImage;
        // $item->summary = $request->summary;
        // $item->brands_id = $request->brands_id;
        // $item->condition = $request->condition;
        // $result = $item->save();

        // if($result){
        //     return redirect()->route('item.index')->with('status', 'Data Item Has Been Saved');
        // }else{
        //     return false;
        // }
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
        $item = Item::find($id);
        $brands = Brands::all();
        $categories = Category::all();
        return view('data_item.editItem', ['item' => $item, 'brands' => $brands, 'categories' => $categories]);
        // return $id;
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
        $dataImage = "";
        $item = Item::findOrFail($id);
        if($request->hasfile('image_item'))
         {
            foreach($request->file('image_item') as $image)
            {
                $imageName = rand(1, 10000). time() . '.' . $image->getClientOriginalExtension();
                $storeDatabase = 'storage/upload/image_item/'. $imageName;
                Image::make($image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_item/') . $imageName);  
                $dataImage .= $storeDatabase.';';  
            }
            $item->image_item = $dataImage;
         }

        $item->displayname = $request->displayname;
        $item->category_id = $request->category_id;
        $item->weight = $request->weight;
        $item->promotion_item = $request->promotion_item;
        $item->price = str_replace(".","",$request->price);
        $item->additionalinfo = $request->additionalinfo;
        $item->description = $request->description;
        $item->summary = $request->summary;
        $item->brands_id = $request->brands_id;
        $item->condition = $request->condition;
        $result = $item->save();

        if($result){
            return redirect()->route('item.index')->with('status', 'Data Item Has Been Edited');
        }else{
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('item.index')->with('status', 'Data Item Has Been Deleted');
    }

    public function apiItem(){
        $item = Item::select('id', 'displayname', 'weight', 'count_view', 'category_id', 'price', 'image_item');

        return Datatables::of($item)
                ->addColumn('image_item', function($item){
                    if($item->image_item == NULL){
                        return 'No Image';
                    }
                    $myArray = explode(';', $item->image_item);
                    return '<img class="rounded-square" width="50" height="50" src="'.asset($myArray[0]).'" alt="">';
                })
                ->addColumn('action', function($item){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("item/$item->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$item->id.'" method="post" action="'.route("item.destroy",$item->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$item->displayname.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$item->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })->rawColumns(['image_item', 'action'])->make(true);
    }
}
