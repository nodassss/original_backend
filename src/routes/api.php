<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\ImageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    
    return ['pong'];
});

// Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout']);

Route::post('/create', [ClothesController::class, 'create']);
Route::get('/index', [ClothesController::class, 'index']);
Route::put('/update', [ClothesController::class, 'update']);
Route::post('delete', [ClothesController::class, 'delete']);

Route::get('/imgindex', [ImageController::class, 'imgindex']);
// Route::post('/store', [ImageController::class, 'store']);
