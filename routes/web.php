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
    return redirect(route('home'));
});

Route::resource('profiles', \App\Http\Controllers\ProfileController::class)->only('show', 'edit', 'update');
Route::resource('posts', \App\Http\Controllers\PostController::class)->except('index');
Route::post('/follow/{profile}', [\App\Http\Controllers\FollowsController::class, 'store']);
\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
