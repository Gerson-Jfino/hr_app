<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Employee;
use App\Sector;
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
Route::get('/pelouros', 'profileController@getPelouros');
Route::post('/employe/company-data', 'profileController@storeCompanyData');
Route::post('/employe/company-data/{id}', 'profileController@updateCompanyData');
Route::get('/me', 'profileController@meAdapter');
Route::get('/testsecto', function () {
    return Sector::with(['regiao', 'UnidadeOrganica'])->get();
});
