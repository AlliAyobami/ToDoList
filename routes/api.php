<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

require __DIR__ .'/api/auth.php';
require __DIR__ .'/api/task.php';
require __DIR__ .'/api/toDoList.php';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
