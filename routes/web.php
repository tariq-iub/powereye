<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/menus', MenuController::class);
    Route::controller(DataFileController::class)
        ->as('files.')
        ->group(function () {
            Route::get('/files', 'index')->name('index');
            Route::get('/files/{data_file}/edit', 'edit')->name('edit');
            Route::put('/files/{data_file}', 'update')->name('update');
            Route::delete('/files/{data_file}', 'destroy')->name('delete');
            Route::get('/files/download/{data_file}', 'download')->name('download');
        });
    Route::resource('/sites', SiteController::class);
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');
});
