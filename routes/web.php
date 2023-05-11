<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/view_job_details', [App\Http\Controllers\JobController::class, 'details'])->name('view_job_details');

Route::get('/create_job', [App\Http\Controllers\JobController::class, 'create'])->name('create_job');

Route::post('/store_job', [App\Http\Controllers\JobController::class, 'store'])->name('store_job');

Route::get('/edit_job', [App\Http\Controllers\JobController::class, 'edit'])->name('edit_job');

Route::get('/job-list', [App\Http\Controllers\JobController::class, 'list_activity'])->name('job-list');

Route::get('/search', [App\Http\Controllers\JobController::class, 'search'])->name('search');

Route::get('/jobview', [App\Http\Controllers\JobController::class, 'jobview'])->name('jobview');

Route::put('job/{id}/update-status', 'JobController@startJob')->name('job.update.status');

Route::put('job/{id}/complete-status', 'JobController@completeJob')->name('job.complete.status');



Route::get('/tv31', [App\Http\Controllers\TvController::class, 'index'])->name('tv31');

Route::get('/tv32', [App\Http\Controllers\TvController::class, 'tv32'])->name('tv32');


// auth routes
// -----------
//client
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::post('/client', [App\Http\Controllers\ClientController::class, 'store'])->name('store');
Route::get('/clientedit-{id}', [App\Http\Controllers\ClientController::class, 'clientedit'])->name('clientedit');
Route::put('/clientedit-{id}', [App\Http\Controllers\ClientController::class, 'clientupdate'])->name('clientupdate');
Route::delete('/client/delete', [App\Http\Controllers\ClientController::class, 'delete'])->name('delete_client');
// Route::resource('/client',App\Http\Controllers\ClientController::class);

//department
Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departmebt');
Route::post('/department', [App\Http\Controllers\DepartmentController::class, 'departmentstore'])->name('departmentstore');

// tv
Route::get('/designing', [App\Http\Controllers\TvController::class, 'index'])->name('designing');

Auth::routes();
