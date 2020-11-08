<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------------------------------------------- 
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list','Users@list');
Route::post('insert_Sign_Data','Users@insert_Sign_Data');
Route::post('insert_Category_Data','Category@insert_Category_Data');
Route::post('category/deleteCategory','Category@deleteCategory');
Route::post('category/statusChangeforCategory','Category@statusChangeforCategory');
Route::get('category/getCategory','Category@getCategory');
Route::post('addProduct/filesUpload','AddProduct@filesUpload');
Route::get('addProduct/getAllProductList','AddProduct@getAllProductList');
Route::post('addProduct/deleteProductItem','AddProduct@deleteProductItem');
Route::post('addProduct/statusChangeforProduct','AddProduct@statusChangeforProduct');
Route::post('addProduct/getProductById','AddProduct@getProductById');
Route::post('addProduct/proItemDetail','AddProduct@proItemDetail');
Route::post('reviewComment/saveCommentReview','ReviewComment@saveCommentReview');
Route::post('reviewComment/getCommentReview','ReviewComment@getCommentReview');
Route::get('dashboard/todalUserProduct','Dashboard@todalUserProduct');





