<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user(): void
    {
        $register = [
            'name' => 'UserTest',
            'email' => 'user@test.com',
            "phone" => "07094647633",
            'password' => 'Testpass100#',
            'password_confirmation' => 'Testpass100#',
        ];

        $response = $this->json(
            'POST',
            'api/v1/auth/register',
            $register
        )->assertStatus(200);
    }

    public function test_register_user_payload_validation(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/auth/register', [
            "name" => "Teyry",
            "email" => "terrold.com",
            "phone" => "07094647633",
            "password" => "Terro100#",
            "password_confirmation" => "Terro100",
        ]);
        $response->assertStatus(422);
    }

    public function test_verify_user_email_failed_required_token(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/v1/auth/verify-user-email?token=&email=terro@ld.com');
        $response->assertStatus(422);
    }

    public function test_verify_user_email_failed_required_email(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/v1/auth/verify-user-email?token=&email=terro@ld.com');
        $response->assertStatus(422);
    }

    public function test_verify_user_email_failed_incorrect_token(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(
            'api/v1/auth/verify-user-email?token=d820291c-560c-41a8-b1d2-4618d23780e1&email=terro@ld.com'
        );
        $response->assertStatus(400);
    }

    public function test_verify_user_email_failed_email_required(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(
            'api/v1/auth/verify-user-email?token=d820291c-560c-41a8-b1d2-4618d23780e1&email='
        );
        $response->assertStatus(422);
    }

    // public function test_verify_user_email(): void
    // {
    //     $response = $this->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->get(
    //         'api/v1/auth/verify-user-email?token=d820291c-560c-41a8-b1d2-4618d23780e1&email=terro@ld.com'
    //     );
    //     $response->assertStatus(422);
    // }

    public function test_login_validation_failed(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/auth/login', [
            "email" => "terroldcom",
            "password" => "Terro100",
        ]);
        $response->assertStatus(422);
    }

    public function test_login_validation(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/auth/login', [
            "email" => "terroldcom",
            "password" => "Terro100",
        ]);
        $response->assertStatus(422);
    }

    public function test_logout_failed(): void
    {
        $user = [
            'name' => 'UserTest',
            'email' => 'user@test.com',
            "phone" => "07094647633",
            'password' => 'Testpass100#',
            'password_confirmation' => 'Testpass100#',
        ];
        $token = 'no Token';
        $response = $this->json("get", "api/v1/auth/logout?token=" . $token);
        $response->assertStatus(400);
    }

    // public function test_logout(): void
    // {
    // $user = [
    //     'name' => 'UserTest',
    //     'email' => 'user@test.com',
    //     "phone" => "07094647633",
    //     'password' => 'Testpass100#',
    //     'password_confirmation' => 'Testpass100#',
    // ];
    // $token = auth('api')->attempt($user);
    // $response = $this->json("get", "api/v1/auth/logout?token=" . $token);
    // $user = User::factory()->create();
    // $response = $this->actingAs($user, 'api')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //         'Authorization' => 'Bearer ' . $token,
    //     ])
    // ->get('api/v1/auth/logout');
    // $response->assertStatus(200);
    // withoutExceptionHandling()
    // $response->dd();
    // }
}
