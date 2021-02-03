<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users/{user}/roles', [UserController::class, 'roles'])->name('user.roles');
Route::put('users/{user}/roles/sync', [UserController::class, 'roleSsync'])->name('user.rolesSync');
Route::resource('users', UserController::class);

Route::get('role/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
Route::put('role/{role}/permissions/sync', [RoleController::class, 'permissionsSync'])->name('role.permissionsSync');
Route::resource('role', RoleController::class);

Route::resource('permission', PermissionController::class);

Route::get('/post', PostController::class, 'index')->name('post.index');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post', 'PostController@store')->name('post.store');

Route::match(['put', 'patch'], '/post/{post}', 'PostController@update')->name('post.update');

Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');