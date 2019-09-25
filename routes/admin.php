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
    Route::resource('etudiants', 'views\admin\EtudiantController');
    Route::resource('formateurs', 'views\admin\FormateurController');
    Route::resource('phases', 'views\admin\PhaseController');
    Route::resource('thematiques', 'views\admin\ThematiqueController');
    Route::resource('budgets', 'views\admin\BudgetController');

    Route::group(['prefix' => 'formations'], function () {
        Route::get('/', 'views\admin\FormationsController@index')->name('formation.index');
        Route::post('/', 'views\admin\FormationsController@store')->name('formation.store');
        Route::get('/create', 'views\admin\FormationsController@create')->name('formation.create');
        Route::get('{number}/edit', 'views\admin\FormationsController@edit')->name('formation.edit');
        Route::get('{number}/show', 'views\admin\FormationsController@show')->name('formation.show');
        Route::put('{number}/edit', 'views\admin\FormationsController@update')->name('formation.update');
        Route::delete('{id}', 'views\admin\FormationsController@destroy')->name('formation.delete');
    });

    Route::group(['prefix' => 'items'], function () {
        Route::post('/', 'views\admin\BudgetController@addBudgetItem')->name('items.store');
        Route::get('{id}', 'views\admin\BudgetItemController@edit')->name('items.edit');
        Route::get('{id}/create', 'views\admin\BudgetItemController@create')->name('items.create');
        Route::put('{id}', 'views\admin\BudgetItemController@update')->name('items.update');
        Route::delete('{id}', 'views\admin\BudgetController@removeBugetItem')->name('items.delete');
    });
});
