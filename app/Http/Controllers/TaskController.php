<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\TimelineService;
use App\Notifications\TimelineNotification;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use App\Models\User;
use App\Models\ToDoList;
use App\Exceptions\TaskException;

class TaskController extends Controller
{
    /**
     * Store a new task for a todo.
     *
     * @param  TaskRequest  $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request, ToDoList $toDo)
    {
        if ($toDo){
        $task = Task::create(array_merge($request->validated(), 
        ['user_id' => auth()->id()], ['to_do_list_id' => $toDo->id]));
        return new JsonResponse ([$task], 201);
        }
        else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'An error occured while trying to create Task'
            ], 400);
    }
    }
      /**
     * Get ToDo List Tasks
     *
     * 
     * @return JsonResponse
     */
    public function getToDoListTasks(string $id)
    {
        try {
        $tasks = Task::query()
        ->where('to_do_list_id', $id)
        ->paginate(5);
        return new JsonResponse ($tasks, 201);
        } catch (\Throwable $th) {
            return TaskException::invalid();
        }
    }

    /**
     * Get a Task by Id
     *
     * @param Task
     * @return JsonResponse
     */
    public function show(Task $task)
    {
        try {
        return new JsonResponse ($task, 201);
        } catch (\Throwable $th) {
            return TaskException::invalid();
        }
    }

    /**
     * Update a Task by Id
     * @param TaskUpdateRequest
     * @param Task
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        if ($task){
            $task->update($request->validated());
            return new JsonResponse ([$task], 201);
            }
            else {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'An error occured while trying to create Task'
                ], 400);
    }
    }
    /**
     * Delete a Task by Id
     * @param Task
     * @return JsonResponse
     */
    public function destroy(Task $task)
    { 
        try {
        $task->delete();
        return new JsonResponse ([], 201);
        } catch (\Throwable $th) {
            return TaskException::invalid();
        }
    }

    /**
     * Calculate a Task Timeline
     * @param Task
     * @return JsonResponse
     */
    public function timeline(
        TimelineService $timelineService,
        TimelineNotification $timelineNotification,
        Task $task)
    { 
        // try {
        if ($task) {
           $interval = $timelineService->calculateTaskProximity($task);
           $notification = $timelineNotification->generateNotification($interval);
           return new JsonResponse (['data' => $notification], 201);
        }
        // } catch (\Throwable $th) {
        //     return TaskException::invalid();
        // }
    }
}
