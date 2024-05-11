<?php

namespace App\Services;

use App\Notifications\EmailVerificationNotification;
use App\Models\EmailVerificationToken;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmailVerificationService
{
 /**
  * Generate verification link
  */

  public function generateVerificationLink(string $email): string{
    $checkTokenExists = EmailVerificationToken::where('email', $email)->first();
    if($checkTokenExists) $checkTokenExists->delete();
     $token = Str::uuid();
     $url = config('app.url'). "?token=".$token . "&email=".$email;
     $saveToken = EmailVerificationToken::create([
        "email" => $email,
        "token" => $token,
        "expired_at" => now()->addMinutes(60),
     ]);
     if($saveToken){
        return $url;
     }
  }

   /**
  * Verify user Token 
  */

  public function verifyToken(string $email, string $token)
  {
    $token = EmailVerificationToken::where('email', $email)->where('token', $token)->first();
    if($token){
        if ($token->expired_at >= now()) {
            return $token;
        }
    } else {
        response()->json([
            'status' => 'failed',
            'message' => 'invalid token'
        ])->send();
        exit;
    }
  }

  /**
  * Send verification link to the user
  */

  public function sendVerificationLink(object $user):void
  {
    Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
  }

  /**
   * Check if User have already been  verified 
   */
  public function checkIfEmailIsVerified($user){
    if($user->email_verified_at){
        response()->json([
            'status' => 'failed',
            'message' => 'Email has already been verified',
        ])->send();
        exit;
    }
}

/**
 * Verify Email
 */
    public function verifyEmail(string $email, string $token){
        $user = User::where('email', $email)->first(); 
        if (!$user){
            response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ])->send();
            exit;
        }
        $this->checkIfEmailIsVerified($user);
        $verifiedToken = $this->verifyToken($email, $token);
        if($user->markEmailAsverified()){
            $verifiedToken->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Email has been verified'
            ]);
        }else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Email verification failed'
            ]);
        }
        }

  /**
   * Resend Link 
   */
  public function resendLink($email){
    $user = User::where("email", $email)->first();
    if($user){
       $this->sendVerificationLink($user);
    }else {
       return response()->json(
        [
            'status' => 'failed',
            'message' => 'User not found'
        ]
        ); 
    }
}

/**
   * Resend Verification Link 
   */
  public function resendEmailVerificationLink(ResendEmailVerificationRequest $request){
     return $this->service->resendLink($user);
}
    
}