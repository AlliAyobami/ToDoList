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
    use RefreshDatabase;
    public function test_create_to_do_list(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/v1/todo/create'
        );
        $toDoList = ToDoList::factory()->create();
        $response->assertStatus(201);
        dump($response->json());
    }

    // /**
    //  * Index Test
    //  */
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
