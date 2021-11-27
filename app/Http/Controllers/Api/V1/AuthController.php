<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ValidateAndCreatePatient;
use App\Http\Traits\ValidateAndCreateUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        $token = auth()->guard('api')->attempt($credentials);
        $user = Auth::guard('api')->user();
        $success = true;


        if (!$token) {
            $success = false;
            return response()->json([
                'success' => $success,
                'error' => 'Unauthorized'
            ],
                401);
        }

        return $this->respondWithToken($token, $success, $user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $user = Auth::guard('api')->user();
        $token = Auth::guard('api')->refresh();
        $success = true;
        return $this->respondWithToken($token, $success, $user);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $success, $user)
    {
        return response()->json([
            'success' => $success,
            'access_token' => $token,
            'user' => $user,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 43800,
        ]);
    }

    public function signup(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $token = auth()->guard('api')->attempt($request->all());
        Auth::guard('api')->login($user);

        $user = Auth::guard('api')->user();
        $success = true;


        return $this->respondWithToken($token, $success, $user);


    }

}
