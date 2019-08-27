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

Route::get('admin/login', 'views\admin\AuthController@login')->name('admin.login');
Route::post('admin/login', 'views\admin\AuthController@signin')->name('admin.signin');

Route::group(['prefix' => 'admin', 'middleware' => ['admin_auth', 'admin']], function() {
    Route::get('/', 'views\admin\AdminController@dashboard')->name('admin');
    Route::get('logout', 'views\admin\AuthController@logout')->name('admin.logout');

    Route::resource('users', 'views\admin\UserController');
    Route::resource('roles', 'views\admin\RoleController');
    Route::resource('permissions', 'views\admin\PermissionController');
    Route::resource('formations', 'views\admin\FormationController');
    Route::resource('etudiants', 'views\admin\EtudiantController');
    Route::resource('formateurs', 'views\admin\FormateurController');
    Route::resource('phases', 'views\admin\PhaseController');
    Route::resource('thematiques', 'views\admin\ThematiqueController');
});
