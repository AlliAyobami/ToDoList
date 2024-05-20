<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\JwtException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Exceptions\UserAuthException;
use App\Http\Requests\RegistrationRequest;
use App\Services\EmailVerificationService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyEmailRequest;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(private EmailVerificationService $mailService)
    {
        # By default we are using here auth:api middleware
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public $loginAfterSignUp = true;

     /**
     * Create new User
     *
     *
     */

    public function register(RegistrationRequest $request)
    {
        try {
            $user = User::create($request->validated());
        } catch (\Throwable $th) {
            UserAuthException::invalid();
        }
        if ($user) {
            $this->mailService->sendVerificationLink($user);
            $token = auth()->login($user);
            return $this->respondWithToken($token, $user);
        }else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'An error occurred while trying to create user'
            ], 500);
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! $token = auth()->attempt($request->validated())) {
            throw JwtException::invalid('invalid credentials');
        }
        return $this->respondWithToken($token, auth()->user());
        // # If all credentials are correct - we are going to generate a new access token and send it back on response
    }

    /**
     * Verify user email
     */
    public function verifyUserEmail(VerifyEmailRequest $request){
        return $this->mailService->verifyEmail($request->email, $request->token);
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
        # This is just logout function that will destroy access token of current user
        auth()->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(User $user)
    {
        # When access token will be expired, we are going to generate a new one wit this function
        # and return it here in response
        return $this->respondWithToken(auth()->refresh(), $user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            'user'  =>  $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'status' => 'success',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
