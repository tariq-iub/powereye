<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\DeviceManagementController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\FactorySensorDataController;
use App\Http\Controllers\FactorySummaryController;
use App\Http\Controllers\FactoryUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteSensorDataController;
use App\Http\Controllers\SiteSummaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BinFileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/roles/attach_menus/{role}', [RoleController::class, 'attachModalBody']);
Route::get('/roles/detach_menus/{role}', [RoleController::class, 'detachModalBody']);
Route::post('/menus/update_order', [MenuController::class, 'updateOrder']);

Route::post('/data/send', [SensorDataController::class, 'storeSensorData']);

Route::post('/data/upload', [DataFileController::class, 'upload'])->name('upload');
Route::post('/data/edit', [DataFileController::class, 'edit'])->name('edit');
Route::post('/data/replace', [DataFileController::class, 'replace'])->name('replace');
Route::get('/factories', [FactoryController::class, 'fetch']);
Route::get('/sites', [SiteController::class, 'fetch']);

Route::post('/factory-users', [FactoryUserController::class, 'store'])->name('api.factory-users.store');

Route::prefix('file-ota')->group(function () {
    Route::get('/', [BinFileController::class, 'index']);
    Route::post('/', [BinFileController::class, 'upload']);
    Route::get('/{id}', [BinFileController::class, 'download']);
    Route::put('/{id}', [BinFileController::class, 'update']);
    Route::delete('/{id}', [BinFileController::class, 'destroy']);
    Route::post('/replace', [BinFileController::class, 'replace']);
});


Route::get('factory/{id}/aggregate-sensor-data', [FactorySensorDataController::class, 'fetch']);

Route::get('factory/{id}/summary/latest', [FactorySummaryController::class, 'getLatestSummary']);

Route::get('site/{id}/summary/latest', [SiteSummaryController::class, 'getLatestSummary']);

Route::get('factory/{factoryId}/{type}', [FactoryController::class, 'fetchData']);
Route::get('site/{siteId}/{type}', [SiteController::class, 'fetchData']);
Route::get('sensor-data/{entityType}/{entityId}/', [SensorDataController::class, 'fetch']);
Route::get('sensor-data/{entityType}/{entityId}/energy', [SensorDataController::class, 'fetchEnergyData']);

Route::get('sensors/fetch/{type}/{id}', [SensorDataController::class, 'f']);

Route::get('factoryData/{factory}', [FactoryController::class, 'fetchFactoryData']);

Route::get('device/get-datetime', [DeviceManagementController::class, 'getDateTime']);

Route::get('fetch-factories', [FactoryController::class, 'fetchFactories']);

Route::get('site/{id}/aggregate-sensor-data', [SiteSensorDataController::class, 'fetch']);
