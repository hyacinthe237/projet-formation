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

Route::get('/', 'views\front\HomeController@home')->name('home');
Route::get('/stagiaires', 'views\front\EtudiantController@create')->name('front.stagiaires.create');
Route::post('/stagiaires', 'views\front\EtudiantController@store')->name('front.stagiaires.store');
Route::get('/formateurs', 'views\front\FormateurController@create')->name('front.formateurs.create');
Route::post('/formateurs', 'views\front\FormateurController@store')->name('front.formateurs.store');
Route::get('/evaluation/finale', 'views\front\EvaluationController@evaluation')->name('evaluation.finale');
Route::post('/evaluation', 'views\front\EvaluationController@store')->name('front.evaluations.store');
Route::get('/besoins', 'views\front\BesoinFormationController@create')->name('front.besoins.create');
Route::post('/besoins', 'views\front\BesoinFormationController@store')->name('front.besoins.store');
