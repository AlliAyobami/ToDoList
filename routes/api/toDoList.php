<?php
use App\Http\Controllers\ToDoListController;

Route::group([
    'middleware' => ['api', 'jwt.auth'],
    'prefix' => 'v1',
    'as' => 'toDo.',
    'namespace' => 'App\Http\Controllers'
], function ($router) {
    Route::post('/todo/create', [ToDoListController::class, 'store'])->name('store');
    Route::get('/todo/user/list', [ToDoListController::class, 'getUserToDoLists'])->name('user.list');
    Route::get('/todo/{todolist}', [ToDoListController::class, 'show'])->name('show');
    Route::put('/todo/update/{todolist}', [ToDoListController::class, 'update'])->name('update');
    Route::delete('/todo/delete/{todolist}', [ToDoListController::class, 'destroy'])->name('delete');
});
