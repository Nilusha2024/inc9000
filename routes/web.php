<?php

use App\Events\JobInserted;
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

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

Route::put('/update_profile', [App\Http\Controllers\UserController::class, 'update_profile'])->name('update_profile');

Route::delete('/delete_user', [App\Http\Controllers\UserController::class, 'delete'])->name('delete_user');

Route::put('/toggle_user_status', [App\Http\Controllers\UserController::class, 'toggleActive'])->name('toggle_user_status');

// job routes

Route::get('/job_details_report', [App\Http\Controllers\JobController::class, 'generateJobDetailReport'])->name('job_details_report');

Route::get('/job', [App\Http\Controllers\JobController::class, 'index'])->name('job');

Route::get('/view_job_details', [App\Http\Controllers\JobController::class, 'details'])->name('view_job_details');

Route::get('/create_job', [App\Http\Controllers\JobController::class, 'create'])->name('create_job');

Route::post('/store_job', [App\Http\Controllers\JobController::class, 'store'])->name('store_job');

Route::get('/edit_job', [App\Http\Controllers\JobController::class, 'edit'])->name('edit_job');

Route::post('/update_job', [App\Http\Controllers\JobController::class, 'update'])->name('update_job');

Route::get('/job-list', [App\Http\Controllers\JobController::class, 'list_activity'])->name('job-list');

Route::get('/search', [App\Http\Controllers\JobController::class, 'search'])->name('search');

Route::get('/jobview', [App\Http\Controllers\JobController::class, 'jobview'])->name('jobview');

Route::put('job/{id}/update-status', 'JobController@startJob')->name('job.update.status');

Route::put('job/{id}/complete-status', 'JobController@completeJob')->name('job.complete.status');

Route::put('job/{jobDepId}/{jobId}/final-status', 'JobController@completeFinalJob')->name('job.final.status');

Route::put('job/{jobDepId}/{jobId}/begin-status', 'JobController@beginJob')->name('job.begin.status');

Route::get('/job_department_records', [App\Http\Controllers\JobController::class, 'job_department_records'])->name('job_department_records');

Route::get('/job_department_token', [App\Http\Controllers\JobController::class, 'job_department_token'])->name('job_department_token');

Route::get('/edit_token/{id}', [App\Http\Controllers\JobController::class, 'edit_token'])->name('edit_token');

Route::post('/update_token', [App\Http\Controllers\JobController::class, 'update_token'])->name('update_token');

Route::post('/check_invoice', [App\Http\Controllers\JobController::class, 'check_invoice'])->name('check_invoice');

Route::post('/deactivate_job', [App\Http\Controllers\JobController::class, 'deactivate_job'])->name('deactivate_job');


// auth routes
// -----------
//client
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::post('/client', [App\Http\Controllers\ClientController::class, 'store'])->name('store');
Route::get('/clientedit-{id}', [App\Http\Controllers\ClientController::class, 'clientedit'])->name('clientedit');
Route::put('/clientedit-{id}', [App\Http\Controllers\ClientController::class, 'clientupdate'])->name('clientupdate');
Route::put('/client-{id}', [App\Http\Controllers\ClientController::class, 'delete'])->name('delete_client');
// Route::resource('/client',App\Http\Controllers\ClientController::class);

//department
Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departmebt');
Route::post('/department', [App\Http\Controllers\DepartmentController::class, 'departmentstore'])->name('departmentstore');

// tv
Route::get('/designing', [App\Http\Controllers\TvController::class, 'designing'])->name('designing');
Route::get('/designing_details', [App\Http\Controllers\TvController::class, 'designing_details'])->name('designing_details');
Route::get('/cutting', [App\Http\Controllers\TvController::class, 'cutting'])->name('cutting');
Route::get('/cutting_details', [App\Http\Controllers\TvController::class, 'cutting_details'])->name('cutting_details');
Route::get('/printing', [App\Http\Controllers\TvController::class, 'printing'])->name('printing');
Route::get('/printing_details', [App\Http\Controllers\TvController::class, 'printing_details'])->name('printing_details');
Route::get('/sewing', [App\Http\Controllers\TvController::class, 'sewing'])->name('sewing');
Route::get('/sewing_details', [App\Http\Controllers\TvController::class, 'sewing_details'])->name('sewing_details');
Route::get('/pressing', [App\Http\Controllers\TvController::class, 'pressing'])->name('pressing');
Route::get('/pressing_details', [App\Http\Controllers\TvController::class, 'pressing_details'])->name('pressing_details');

Auth::routes();
