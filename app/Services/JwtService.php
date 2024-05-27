<?php

namespace App\Services;

use App\Exceptions\UserAuthException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JwtService
{
    /**
     * Get user token
     * @param User
     * @return \Illuminate\Http\JsonResponse
     */
    public function createToken(User $user, string $message): JsonResponse
    {
        $token = auth()->login($user);
        return $this->respondWithToken($token, $message);
    }

    /**
     * Refresh a token.
     * @param User
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh($message = 'User token refreshed'): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh(), $message);
    }

    /**
     * verify user credential and return either token or an unauthorized error
     * @param array
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyLoginCredentials(array $credentials): JsonResponse
    {
        if (!auth()->validate($credentials)) {
            throw UserAuthException::invalid();
        }
        $user = User::where('email', $credentials['email'])->first();
        return $this->createToken($user, 'Login Successful');
    }

    /**
     * verify user credential and return either token or an unauthorized error
     * @param array
     */
    public function isVerifiedUser(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !$user->email_verified_at) {
            throw UserAuthException::notVerified();
        }
    }

    /**
     * Get user token
     * @param User
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(
        string $token,
        string $message
    ): JsonResponse {
        return response()
            ->json([
                'status' => 'success',
                'message' => $message,
            ])
            ->withHeaders(['authorization' => $token]);
    }
}
