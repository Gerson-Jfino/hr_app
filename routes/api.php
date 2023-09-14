<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\NivelAcademico;
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

Route::middleware('auth:api')->get('/user', function () {
    return "teste";
});
Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});
Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/pelouros', 'profileController@getPelouros');
    Route::post('/employe/company-data', 'profileController@storeCompanyData');
    Route::post('/employe/company-data/{id}', 'profileController@updateCompanyData');
    Route::post('/employe/personal-data', 'profileController@storePesonalData');
    Route::post('/employe/personal-data/{id}', 'profileController@updatePesonalData');
    Route::post('/employe/nivel-academico', 'profileController@storeNivelAcademicoData');
    Route::post('/employe/nivel-academico/{id}', 'profileController@updateNivelAcademicoData');
    Route::get('/testsecto', function () {
    });
    return NivelAcademico::get();
});
Route::get('/getMe', 'profileController@meAdapter');
