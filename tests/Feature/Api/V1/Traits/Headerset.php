<?php

namespace Tests\Feature\api\V1\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

trait Headerset
{
    protected function apiAs(
        $user,
        $method,
        $uri,
        array $data = [],
        array $headers = []
    ) {
        $headers = array_merge(
            [
                'Authorization' => 'Bearer ' . \JWTAuth::fromUser($user),
            ],
            $headers
        );

        return $this->api($method, $uri, $data, $headers);
    }

    protected function api($method, $uri, array $data = [], array $headers = [])
    {
        return $this->json($method, $uri, $data, $headers);
        $response->assertStatus(200);
    }

    public function assertHeadersWithToken($user){
        $auth =  new
        $token = \PHPOpenSourceSaver\JWTAuth\JWTAuth::fromUser($user);
    }

    public function assertHeadersWithoutToken($status, $message = ''){

    }
}
