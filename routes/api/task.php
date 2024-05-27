<?php
use App\Http\Controllers\TaskController;

Route::group(
    [
        'middleware' => ['jwt.auth'],
        'prefix' => 'v1',
        'as' => 'task.',
        'namespace' => 'App\Http\Controllers',
    ],
    function ($router) {
        Route::post('/todo/{todolist}/task', [
            TaskController::class,
            'store',
        ])->name('store');

        Route::get('/todo/{id}/task', [
            TaskController::class,
            'getToDoListTasks',
        ])->name('lists');

        Route::get('/task/{task}', [TaskController::class, 'show'])->name(
            'show'
        );

        Route::put('/task/{task}/update', [
            TaskController::class,
            'update',
        ])->name('update');

        Route::delete('/task/{task}/delete', [
            TaskController::class,
            'destroy',
        ])->name('delete');

        Route::get('/task/{task}/timeline', [
            TaskController::class,
            'timeline',
        ])->name('interval');
    }
);
