<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
//use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1'], function () {

    Route::get('/', [GeneralController::class, 'initial']);

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/profile', [AuthController::class, 'profileUser'])->middleware('auth:sanctum');
});

Route::fallback([GeneralController::class, 'fallbackRoute']);
