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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/permissions', 'PermissionController@Permissions');

Auth::routes();

Route::get('/role', 'PermissionController@roleIndex')->name('role.index');
Route::post('/role/store', 'PermissionController@roleStore')->name('role.store');
Route::put('/role/update/{id}', 'roleController@roleUpdate')->name('role.update');
Route::delete('/role/delete/{id}', 'roleController@roleDelete')->name('role.destroy');

Route::get('/permission', 'PermissionController@permissionIndex')->name('permission.index');
Route::post('/permission/store', 'PermissionController@permissionStore')->name('permission.store');
Route::put('/permission/update/{id}', 'PermissionController@permissionUpdate')->name('permission.update');
Route::delete('/permission/delete/{id}', 'PermissionController@permissionDelete')->name('permission.destroy');

Route::get('/roles', 'PermissionController@Permission');
Route::get('/home', 'HomeController@index')->name('home');
