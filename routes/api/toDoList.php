<?php
use App\Http\Controllers\ToDoListController;

Route::group(
    [
        'middleware' => ['jwt.auth'],
        'prefix' => 'v1',
        'as' => 'toDo.',
        'namespace' => 'App\Http\Controllers',
    ],
    function ($router) {
        Route::post('/todo/create', [
            ToDoListController::class,
            'create',
        ])->name('create');

        Route::get('/todo/user/lists', [
            ToDoListController::class,
            'getUserToDoLists',
        ])->name('user.lists');

        Route::get('/todo/{todolist}', [
            ToDoListController::class,
            'show',
        ])->name('show');

        Route::put('/todo/update/{todolist}', [
            ToDoListController::class,
            'update',
        ])->name('update');

        Route::delete('/todo/delete/{todolist}', [
            ToDoListController::class,
            'destroy',
        ])->name('delete');
    }
);
