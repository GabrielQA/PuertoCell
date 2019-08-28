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

Route::group(['middleware' => ['web']], function () {
    //<span class="typ">Route</span><span class="pun">::</span><span class="kwd">get</span><span class="pun">(</span><span class="str">'payPremium'</span><span class="pun">,</span> <span class="pun">[</span><span class="str">'as'</span><span class="pun">=></span><span class="str">'payPremium'</span><span class="pun">,</span><span class="str">'uses'</span><span class="pun">=></span><span class="str">'PaypalController@payPremium'</span><span class="pun">]);</span>    
   Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
       Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
       Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
   });

   Route::group(['middleware' => ['web']], function () {
    //<span class="typ">Route</span><span class="pun">::</span><span class="kwd">get</span><span class="pun">(</span><span class="str">'payPremium'</span><span class="pun">,</span> <span class="pun">[</span><span class="str">'as'</span><span class="pun">=></span><span class="str">'payPremium'</span><span class="pun">,</span><span class="str">'uses'</span><span class="pun">=></span><span class="str">'PaypalController@payPremium'</span><span class="pun">]);</span>    
   Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
       Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
       Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
   });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
