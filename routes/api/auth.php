<?php
use App\Http\Controllers\Auth\AuthController;

Route::group([
    'middleware' => ['api'],
    'prefix' => 'v1',
    'as' => 'users.',
    'namespace' => 'App\Http\Controllers\Auth'
], function ($router) {
    Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/verify-user-email', [AuthController::class, 'verifyUserEmail'])->name('verifyUserEmail');
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});