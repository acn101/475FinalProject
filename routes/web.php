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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/worker', 'WorkerController@index');
Route::post('/worker/store', 'WorkerController@store');
Route::get('/worker/edit/{id}', 'WorkerController@edit');
Route::post('/worker/update/{id}', 'WorkerController@update');

Route::get('/workercerts/edit/{id}', 'WorkerCertsController@edit');
Route::post('/workercerts/update/{id}', 'WorkerCertsController@update');

Route::get('/jobs', 'WorkOrderController@index');
Route::post('/jobs/submit/{id}', 'WorkerTicketsController@update');
