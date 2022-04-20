<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\PublicController;
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
    return view('dashboard');
});


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('forms', [FormsController::class, 'index'])->name('forms');
    Route::get('forms/create', [FormsController::class, 'create'])->name('forms.create');
    Route::post('forms/store', [FormsController::class, 'store'])->name('forms.store');
    Route::get('forms/show', [FormsController::class, 'index'])->name('forms.index');
    Route::get('forms/edit/{id}', [FormsController::class, 'edit'])->name('forms.edit');
    Route::post('forms/destroy/{id}', [FormsController::class, 'destroy'])->name('forms.destroy');
    Route::post('forms/update/{id}', [FormsController::class, 'update'])->name('forms.update');
    Route::get('forms/submissions/{id}', [FormsController::class, 'submissions'])->name('forms.submissions');
});


Route::get('public/forms', [PublicController::class, 'index'])->name('public.forms');
Route::get('public/forms/show/{id}', [PublicController::class, 'show'])->name('public.forms.show');
Route::post('public/forms/store', [PublicController::class, 'store'])->name('public.forms.store');
