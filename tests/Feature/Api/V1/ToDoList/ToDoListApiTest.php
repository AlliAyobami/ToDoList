<?php

namespace Tests\Feature\Api\V1\ToDoList;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\ToDoList;
use App\Models\User;
use Tests\TestCase;

class ToDoListApiTest extends TestCase
{
    public function test_failed_to_create_to_do_list(): void
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
            'api/v1/todo/create'
        );
        $toDoList = ToDoList::factory()->create();
        $response->assertStatus(401);
    }

    /**
     * Index Test
     */
    // public function test_index(): void
    // {
    //     // $user = User::factory()->create();
    //     $response = $this->actingAs($user, 'api')->json(
    //         'get',
    //         'api/v1/todo/user/list'
    //     );
    //     // $toDoList = ToDoList::factory()->create();
    //     $response->assertStatus(201);
    //     dump($response->json());
    // }
}
