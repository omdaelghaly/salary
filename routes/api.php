<?php

use App\Http\Controllers\logcontroller;
use App\Http\Middleware\resTOjson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','logcontroller@register');
Route::post('login','logcontroller@login');

Route::post('saveschool','schoolcontroller@saveschool');
Route::post('getschools','schoolcontroller@getschools');

Route::post('getthisschool','schoolcontroller@getthisschool');
Route::post('updateschool','schoolcontroller@updateschool');

Route::get('getschoolsinfo/{id}','empcontroller@getschoolsinfo');
Route::post('addemp','empcontroller@addemp');
Route::post('getallempsinfo','empcontroller@getallempsinfo');

