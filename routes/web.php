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

Auth::routes(['register' => config('auth.register', false)]);

Route::get('/', 'HomeController@index')->name('home');

Route::get(
    '/users/{user}/files/{file}',
    'BinaryController@show'
)->name('users.files.show');
Route::post(
    '/users/{user}/files',
    'BinaryController@create'
)->name('users.files.create');
Route::delete(
    '/users/{user}/files',
    'BinaryController@delete'
)->name('users.files.delete');
