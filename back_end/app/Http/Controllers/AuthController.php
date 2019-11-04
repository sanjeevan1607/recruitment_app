<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login', 'register']]);
    }


    protected function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($validator->fails()) {

            return json_response(false, 'Validation  Error', null, 400);
        }
        $userInfo = request(['email', 'password', 'first_name', 'last_name']);
        $user = User::create(
            [
                'name' => $userInfo['first_name'] . ' ' . $userInfo['last_name'],
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['password']),
                'profile_image' => settingData('profile_image_default'),
            ]);
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        $tokenData = array('access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'uID' => auth()->user()->id);
        return json_response(true, 'done', $tokenData, 200);

    }


    /**
     * This  is  API  login  function
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return json_response(false, 'Validation  Error', null, 400);
        }
        $input = $request->all();
        if (!$token = auth()->attempt($input)) {

            return json_response(false, 'Validation  Error', null, 400);
        } else {

            $tokenData = array('access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'uID' => auth()->user()->id);
            return json_response(true, 'done', $tokenData, 200);

        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {

        $output = new  UserResource(auth()->user());
        return json_response(true, 'done', $output, 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return array(
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        );
    }
}
