<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/welcode', function () {
    return view('welcome');
});


Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/developer-weekly-list', 'TodoController@index')->name('developer.weekly.list');
Route::get('/developer-list', 'TodoController@developerList')->name('developer.list');
Route::get('/developer-task-list', 'TodoController@todoList')->name('developer.task.list');
