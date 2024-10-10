<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\FactoryUserController;
use App\Http\Controllers\FaqController;
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

    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');

    Route::put('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');
    Route::resource('/menus', MenuController::class);
    Route::put('/menus/status/{menu}', [MenuController::class, 'statusToggle'])->name('menus.toggle');

    Route::resource('/roles', RoleController::class);
    Route::post('/roles/role_menu_attachment', [RoleController::class, 'roleMenuAttachment'])->name('roles.role_menu_attachment');
    Route::post('/roles/role_menu_detachment', [RoleController::class, 'roleMenuDetachment'])->name('roles.role_menu_detachment');

    Route::resource('/factories', FactoryController::class);
    Route::resource('/sites', SiteController::class);
    Route::resource('/devices', DeviceController::class);

    Route::controller(DataFileController::class)
        ->as('files.')
        ->group(function () {
            Route::get('/files', 'index')->name('index');
            Route::get('/files/create', 'create')->name('create');
            Route::post('/files/store', 'store')->name('store');
            Route::get('/files/{data_file}/edit', 'edit')->name('edit');
            Route::put('/files/{data_file}', 'update')->name('update');
            Route::delete('/files/{data_file}', 'destroy')->name('delete');
            Route::get('/files/download/{data_file}', 'download')->name('download');
            Route::get('/files/data', 'getData')->name('data');
            Route::get('/files/{data_file}', 'show')->name('show');
        });

    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');

    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
});
