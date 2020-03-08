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

Route::pattern('id', '[0-9]+');
Route::resource('task', 'TasksController');
Route::get('task', 'TasksController@index');
Route::get('task/create', 'TasksController@create');
Route::post('task/store', 'TasksController@store');
// Edit Task
Route::get('edit/{id?}', 'TasksController@edit');
Route::post('update/{id?}', 'TasksController@update');
// Delete Task
Route::get('delete/{id?}', 'TasksController@destroy');
Route::get('trashed', 'TasksController@task_trashed');
Route::get('forcedelete/{id?}', 'TasksController@forcedelete');
Route::get('restore/{id}', 'TasksController@restore');

