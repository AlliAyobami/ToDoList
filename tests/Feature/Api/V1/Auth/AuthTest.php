<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/v1/auth/register', [
            "name" => "Teyry",
            "email" => "terro@ld.com",
            "phone" => "07094647633",
            "password" => "Terro100#",
            "password_confirmation" => "Terro100#",
        ]);
        $response->assertStatus(200);
    }

    // public function test_verify_user_email(): void
    // {
    //     $response = $this->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->get('api/v1/auth/verify-user-email?token=&email=terro@ld.com');
    //     $response->assertStatus(200);
    // }
}
