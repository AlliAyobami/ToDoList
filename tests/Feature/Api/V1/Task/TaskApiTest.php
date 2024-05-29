<?php

namespace Tests\Feature\Api\V1\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\ToDoList;
use App\Models\User;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    public function test_failed_to_create_task_list_due_to_absence_of_to_do_list(): void
    {
        $user = [
            'name' => 'UserTest',
            'email' => 'user@test.com',
            "phone" => "07094647633",
            'password' => 'Testpass100#',
            'password_confirmation' => 'Testpass100#',
        ];
        $token = auth('api')->attempt($user);
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/v1/todo/1/task'
        );
        $task = Task::factory()->create();
        $response->assertStatus(404);
        // $response->dd();
    }
}
