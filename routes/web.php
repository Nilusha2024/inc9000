<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|a
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// no controller routes
// --------------------

Route::get('/general', function () {
    return view('general');
})->name('general');

// rotues
// ------

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user routes

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');

Route::post('/store_user', [App\Http\Controllers\UserController::class, 'store'])->name('store_user');

Route::get('/edit_user', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_user');

Route::put('/update_user', [App\Http\Controllers\UserController::class, 'update'])->name('update_user');

Route::delete('/delete_user', [App\Http\Controllers\UserController::class, 'delete'])->name('delete_user');

// job routes

Route::get('/job', [App\Http\Controllers\JobController::class, 'index'])->name('job');

Route::get('/create_job', [App\Http\Controllers\JobController::class, 'create'])->name('create_job');

Route::post('/store_job', [App\Http\Controllers\JobController::class, 'store'])->name('store_job');

Route::get('/job-list', [App\Http\Controllers\JobController::class, 'list'])->name('job-list');

Route::get('/search', ['uses' => 'JobController@search','as' => 'search']);

// Route::get('/search', [App\Http\Controllers\JobController::class, 'search'])->name('search');

Route::get('/jobview/{id}', [App\Http\Controllers\JobController::class, 'jobview'])->name('jobview');

// auth routes
// -----------

Auth::routes();
