<?php

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProveedoresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('v1/proveedores', [ProveedoresController::class, 'index']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/'

], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout'])->name('logout');


    // Route::post('me', [\App\Http\Controllers\Api\V1\AuthController::class, 'me'])->name('me');
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('v1/admins', [AdminController::class, 'show']);
    Route::post('v1/admins', [AdminController::class, 'store']);
});
