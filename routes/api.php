<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CommentController;

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

Route::post('/auth/login', [AuthController::class, 'login'])->middleware('guest:api');
Route::post('/auth/register', [AuthController::class, 'register'])->middleware('guest:api');
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/auth/me', [AuthController::class, 'getActiveUser'])->middleware('auth:api');
Route::post('auth/refresh', [AuthController::class, 'refreshToken']);

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/galleries/{id}', [GalleryController::class, 'show']);
Route::post('/galleries', [GalleryController::class, 'store'])->middleware('auth:api');
Route::put('/galleries/{id}', [GalleryController::class, 'update'])->middleware('auth:api');
Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->middleware('auth:api');

Route::get('/galleries/{id}/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/galleries/{id}/comments', [CommentController::class, 'store'])->middleware('auth:api');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('auth:api');
