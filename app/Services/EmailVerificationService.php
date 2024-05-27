<?php

namespace App\Services;

use App\Exceptions\TokenException;
use App\Exceptions\UserAuthException;
use App\Http\Requests\ResendEmailVerificationRequest;
use App\Notifications\EmailVerificationNotification;
use App\Models\EmailVerificationToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmailVerificationService
{
    /**
     * Generate verification link
     */

    public function generateVerificationLink(string $email): string
    {
        $checkTokenExists = EmailVerificationToken::where(
            'email',
            $email
        )->first();
        if ($checkTokenExists) {
            $checkTokenExists->delete();
        }
        $token = Str::uuid();
        $url =
            config('app.url') .
            "/api/v1/auth/verify-user-email" .
            "?token=" .
            $token .
            "&email=" .
            $email;
        $saveToken = EmailVerificationToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addMinutes(60),
        ]);
        if ($saveToken) {
            return $url;
        }
    }

    /**
     * Verify user Token
     */

    public function verifyToken(string $token)
    {
        $emailVerificationToken = EmailVerificationToken::where(
            'token',
            $token
        )->first();
        if ($emailVerificationToken) {
            if ($emailVerificationToken->expired_at >= now()) {
                return $token;
            }
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'Token as Expired',
            ]);
        }
    }

    /**
     * Send verification link to the user
     */

    public function sendVerificationLink(User $user): void
    {
        Notification::send(
            $user,
            new EmailVerificationNotification(
                $this->generateVerificationLink($user->email)
            )
        );
    }

    /**
     * Check if User have already been  verified
     * @param User $user
     */
    public function checkIfEmailIsVerified(User $user)
    {
        if ($user->email_verified_at) {
            response()->json([
                'status' => '401',
                'message' => 'Email has already been verified',
            ]);
        }
    }

    /**
     * Verify user email
     * @param string
     * @return JsonResponse|User
     */
    public function verifyEmail(string $email): JsonResponse|User
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw UserAuthException::notFound();
        }
        $this->checkIfEmailIsVerified($user);
        $user->email_verified_at = strtotime(now());
        $user->save();
        return $user;
    }

    public function verifyCredentials(array $credentials, JwtService $jwt)
    {
        $verifiedUser = $this->verifyEmail($credentials['email']);
        $verifiedToken = $this->verifyToken($credentials['token']);
        if ($verifiedToken) {
            $newToken = $jwt->createToken($verifiedUser, 'verification successful');
            return response()
                ->json([
                    'verifiedUser' => $verifiedUser,
                ])
                ->withHeaders(['authorization' => $newToken]);
        }
        throw TokenException::wrong();
    }
    /**
     * Resend Link
     */
    public function resendLink($email)
    {
        $user = User::where("email", $email)->first();
        if ($user) {
            $this->sendVerificationLink($user);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'User not found',
            ]);
        }
    }

    /**
     * Resend Verification Link
     */
    public function resendEmailVerificationLink(
        ResendEmailVerificationRequest $request,
        User $user
    ) {
        return $this->resendLink($user->email);
    }
}
