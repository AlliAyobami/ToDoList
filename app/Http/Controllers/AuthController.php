<?php

namespace App\Http\Controllers;

use App\Exceptions\JwtException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Exceptions\UserAuthException;
use App\Http\Requests\RegistrationRequest;
use App\Services\EmailVerificationService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(private EmailVerificationService $mailService)
    {
        // $this->middleware('auth:api', ['except' => ['login', 'store']]);
    }
    public $loginAfterSignUp = true;

    /**
     * Create new User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        RegistrationRequest $request,
        EmailVerificationService $mailService,
        JwtService $jwt
    ) {
        try {
            $user = User::create($request->validated());
            if ($user) {
               $mailService->sendVerificationLink($user);
               return $jwt->createToken($user);
            }
        } catch (\Throwable $th) {
            UserAuthException::invalid();
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, JwtService $jwt)
    {
        try {
            $jwt->isVerifiedUser($request->validated());
            return $jwt->verifyLoginCredentials($request->validated());
        } catch (\Exception $exception) {
            abort(400, $exception->getMessage());
        }
    }
    /**
     * Verify user email
     * @param VerifyEmailRequest
     * @param EmailVerificationService
     */
    public function verifyUserEmail(
        VerifyEmailRequest $request,
        EmailVerificationService $mailService,
        JwtService $jwt
    ) {
        try {
         $mailService->verifyCredentials($request->validated(), $jwt);
         return response()
                ->json([
                    'status' => 'success',
                    'message' => 'User is verified',
                ]);
            } catch (\Exception $exception) {
               abort(400, $exception->getMessage());
            }
        //  return redirect()->route('user.login', $user);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        # Here we just get information about current user
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
        }
        catch (\Exception $exception) {
        abort(400, $exception->getMessage());
        }

    }

}
