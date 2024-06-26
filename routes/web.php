<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/reports', function () {
    return view('reports.index');
})->name('reports');

Route::get('/sites/{site}', [SiteController::class, 'show'])->name('sites.show');
Route::resource('/roles', RoleController::class);
Route::resource('/users', UserController::class);
Route::resource('/files', DataFileController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
//    Route::resource('/users', UserController::class);
    Route::resource('/menus', MenuController::class);
});
