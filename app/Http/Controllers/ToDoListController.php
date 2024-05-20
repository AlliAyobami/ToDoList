<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ToDoListRequest;
use App\Http\Requests\ToDoUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Models\ToDoList;
use App\Models\User;
use App\Exceptions\ToDoException;

class ToDoListController extends Controller
{
    /**
     * Store a new todo.
     *
     * @param  ToDoListRequest  $request
     * @return JsonResponse
     */
    public function store(ToDoListRequest $request)
    {
        try {
        $toDo = ToDoList::create(array_merge($request->validated(), ['user_id' => auth()->id()]));
        return new JsonResponse ([$toDo], 201);
        } catch (\Throwable $th) {
            return ToDoException::invalid('Invalid Request');
        }
    }

      /**
     * Get ToDoList created by user
     *
     *
     * @return JsonResponse
     */
    public function getUserToDoLists()
    {
        try {
        $user_id = auth()->id();
        $userToDos = ToDoList::query()
            ->where('user_id', $user_id)
            ->paginate(5);
        return new JsonResponse ([$userToDos], 201);
        } catch (\Throwable $th) {
            return ToDoException::invalid('Invalid Request');
        }
    }

    /**
     * Get a ToDoList by Id
     *
     * @param ToDoList
     * @return JsonResponse
     */
    public function show(ToDoList $toDo)
    {
        try {
        return new JsonResponse ($toDo, 201);
        } catch (\Throwable $th) {
            return ToDoException::invalid('Invalid request');
        }
    }

    /**
     * Update a ToDoList by Id
     * @param ToDoUpdateRequest
     * @param ToDoList
     * @return JsonResponse
     */
    public function update(ToDoUpdateRequest $request, ToDoList $toDo)
    {
        try {
         $toDo->update($request->validated());
        return new JsonResponse ($toDo, 201);
        } catch (\Throwable $th) {
            return ToDoException::invalid('Invalid request');
        }
    }

    /**
     * Delete a ToDoList by Id
     * @param ToDoList
     * @return JsonResponse
     */
    public function destroy(ToDoList $toDo)
    {
        try {
        $toDo->delete();
        return new JsonResponse ([], 201);
        } catch (\Throwable $th) {
            return ToDoException::invalid('Invalid request');
        }
    }
}
