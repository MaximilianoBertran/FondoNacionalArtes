<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\UserController;
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
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users/stadistics', [UserController::class, 'index']);
});
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('user', [AuthController::class, 'user']);
    });
});
Route::prefix('articles')->group(function () {
    Route::post('{article_id}/comments', [CommentController::class, 'store']);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('/user/{user_id}', [ArticleController::class, 'index']);
        Route::post('{article_id}/photos', [PhotoController::class, 'store']);
        Route::delete('{article_id}/photos/{photo_id}', [PhotoController::class, 'destroy']);
        Route::delete('{article_id}/comments/{comment_id}', [CommentController::class, 'destroy']);
        Route::post('/', [ArticleController::class, 'store']);
        Route::delete('{article_id}', [ArticleController::class, 'destroy']);
    });
});
