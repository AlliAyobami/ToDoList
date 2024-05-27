<?php

namespace App\Http\Controllers;

use App\Exceptions\JwtException;
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
    public function create(ToDoListRequest $request)
    {
        $toDo = ToDoList::create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );
        return new JsonResponse([$toDo], 201);
    }

    /**
     * Get ToDoList created by user
     *
     *
     * @return JsonResponse
     */

    public function getUserToDoLists()
    {
        $user_id = auth()->id();
        if ($user_id) {
            $userToDos = ToDoList::query()
                ->where('user_id', '=', $user_id)
                ->paginate(5);
            return response()->json([
                'status' => 'success',
                'data' => $userToDos,
            ]);
        }
        abort(401, 'Unauthorized access');
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
            return new JsonResponse($toDo, 200);
        } catch (\Throwable $th) {
            throw ToDoException::invalid();
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
            return new JsonResponse($toDo, 200);
        } catch (\Throwable $th) {
            throw ToDoException::invalid();
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
            return new JsonResponse([], 200);
        } catch (\Throwable $th) {
            throw ToDoException::invalid();
        }
    }
}
