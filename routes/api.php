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
    Route::post('register', 'UserController@autoRegister');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});
Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/pelouros', 'profileController@getPelouros');
    Route::post('/employe/company-data', 'profileController@storeCompanyData');
    Route::post('/admin/employe/company-data', 'adminController@storeCompanyData');
    Route::post('/employe/company-data/{id}', 'profileController@updateCompanyData');
    Route::post('/employe/personal-data', 'profileController@storePesonalData');
    Route::post('/admin/employe/personal-data', 'adminController@storePesonalData');
    Route::post('/employe/personal-data/{id}', 'profileController@updatePesonalData');
    Route::post('/employe/nivel-academico', 'profileController@storeNivelAcademicoData');
    Route::post('/admin/employe/nivel-academico', 'adminController@storeNivelAcademicoData');
    Route::post('/employe/documento', 'profileController@saveDocs');
    Route::post('/employe/nivel-academico/{id}', 'profileController@updateNivelAcademicoData');
    Route::get('/testsecto', function () {
    });
    Route::get('/getMe', 'profileController@meAdapter');
    Route::get('/get-colaboradores', 'adminController@getColaboradores');
    Route::get('/colaborador/{id}', 'adminController@showColaborador');
    Route::get('/get-asseduidades', 'adminController@getAsseduidades');
    Route::get('/get-users', 'adminController@getUsers');
    Route::post('/new-user', 'adminController@newUser');
    Route::match(['put', 'post'], '/update-user/{id}', 'adminController@updateUser');
    Route::get('/get-roles', 'adminController@getRoles');
    Route::post('/save-asseduidades', 'adminController@storeAssiduidade');
    Route::post('/save-desempenho', 'adminController@storeDesempenho');
    Route::match(['put', 'post'], '/update-asseduidades/{id}', 'adminController@updateAssiduidade');
    Route::get('/get-colaboradores-list', 'adminController@getEmployes');
    Route::get('/get-desempenhos', 'adminController@getDesempenhos');
    Route::get('/relatorios', 'adminController@relatorios');
    Route::get('/createTempUser', 'adminController@createTempUser');
    // return NivelAcademico::get();
});
