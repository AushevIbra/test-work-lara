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

Route::post('/change-price/{id}', function ($id){
    $product = \App\Models\Product::find($id)->update([
        'price' => \request('price')
    ]);
    return ($product == true) ? response()->json(['msg' => 'success']) : response()->json(['msg' => 'error'], 400);
});
