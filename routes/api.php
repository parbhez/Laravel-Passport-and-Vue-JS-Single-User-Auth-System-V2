<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){

    /**
     * our routes to be Public will go in here
     */

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function(){
        return response()->json(['message' => 'Unauthorised'], 401);
    })->name('login');

    Route::get('/getloggined', [AuthController::class, 'me']);


    Route::middleware('auth:api')->group(function(){

        /**
        * our routes to be Protected will go in here
        */

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/users/{id}', [AuthController::class, 'show']);
        Route::get('/users', [AuthController::class, 'index']);
        Route::get('/user/me', [AuthController::class, 'me'])->name('user.me');

        //Category route
        Route::resource('blogs', BlogController::class)->except('create','edit');

        Route::get('/blogs/change/{id}', [BlogController::class, 'change'])->name('blogs.change');
        Route::resource('categories', CategoryController::class)->except('create','edit');
    });

});

