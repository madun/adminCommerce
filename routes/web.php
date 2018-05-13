<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'DashboardController@index')->name('home');

    Route::resource('item', 'ItemController');
    Route::get('api/item', 'ItemController@apiItem')->name('api.item'); // untuk datatable yajra

    Route::resource('category', 'CategoryController');
    Route::get('api/category', 'CategoryController@apiCategory')->name('api.category'); // untuk datatable yajra
    Route::get('api/select/category', 'CategoryController@apiForSelect')->name('api.select.category'); // api select

    Route::resource('brand', 'BrandController');
    Route::get('api/brands', 'BrandController@apiBrands')->name('api.brands'); // untuk datatable yajra


    Route::resource('banner', 'BannerController');
    Route::get('api/banner', 'BannerController@apiBanner')->name('api.banner'); // untuk datatable yajra


    Route::resource('voucher', 'VoucherController');
    Route::get('api/voucher', 'VoucherController@apiVoucher')->name('api.voucher'); // untuk datatable yajra

    Route::resource('mail', 'MailController');
    Route::get('api/mail', 'MailController@apiMailTemplate')->name('api.mailTemplate'); // untuk datatable yajra



// image in desc upload
    Route::post('upload_img/desc', function (){
        $image = Input::file('file');
        $filename = 'img-desc'.rand(10, 99999999).'.'.$image->getClientOriginalExtension();
        // $move = $image->storeAs('public/upload/image_desc', $filename);
        $move = Image::make($image->getRealPath())->resize(500, 400)->save(public_path('storage/upload/image_desc/') . $filename);

        if($move){
            return response()->json([
                'filelink'=> url('storage/upload/image_desc/'.$filename)
            ]);
        }else{
            return response()->json([
                'error'=> true
            ]);
        }
    });

    // image in desc upload mail template
    Route::post('mail_image/desc', function (){
        $image = Input::file('file');
        $filename = 'img-desc'.rand(10, 99999999).'.'.$image->getClientOriginalExtension();
        // $move = $image->storeAs('public/upload/image_desc', $filename);
        $move = Image::make($image->getRealPath())->save(public_path('storage/upload/mail_image/') . $filename);

        if($move){
            return response()->json([
                'filelink'=> url('storage/upload/mail_image/'.$filename)
            ]);
        }else{
            return response()->json([
                'error'=> true
            ]);
        }
    });
});