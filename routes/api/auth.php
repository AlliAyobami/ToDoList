<?php

use App\Http\Controllers\AuthController;

Route::group(
    [
        'middleware' => ['api'],
        'prefix' => 'v1',
        'as' => 'users.',
        'namespace' => 'App\Http\Controllers\Auth',
    ],
    function ($router) {
        Route::post('/auth/register', [AuthController::class, 'store'])->name(
            'register'
        );

        Route::get('/auth/verify-user-email', [
            AuthController::class,
            'verifyUserEmail',
        ])->name('verifyUserEmail');

        Route::post('/auth/login', [AuthController::class, 'login'])->name(
            'login'
        );

        Route::get('/auth/logout', [AuthController::class, 'logout'])->name(
            'logout'
        );
    }
);
