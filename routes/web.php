<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\MissionVendorController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\Admin\RequestedController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MissionController;

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
    return view('welcome');
})->name('front_view');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');


    //requested list
    // Route::get('requested', [App\Http\Controllers\Admin\RequestedController::class, 'index'])->name('admin.requested');
    // Route::get('requested/create', [App\Http\Controllers\Admin\RequestedController::class, 'create']);
    Route::resource('requested', RequestedController::class);
    Route::post('/vehicles/update_vehicle/{id}', [VehiclesController::class, 'partsUsed']);
    Route::resource('vehicles', VehiclesController::class);

    Route::resource('missions', MissionController::class);
    Route::resource('maintenance',MaintenanceController::class);
});
