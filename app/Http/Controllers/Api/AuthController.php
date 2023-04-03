<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */

    public function index(): JsonResponse
    {
        $data = User::all();
        if ($data)
            return respondSuccess("Data retrieve successfully", $data);
        else
            return respondError('No data available', '', 404);
    }

    /**
     * Show the User Login.
     */

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return respondError(VALIDATION_ERROR, $validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            return respondSuccess("You are successfully logged in", $data, 200);
        } else {
            return respondError(UNAUTHORIZED, '', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $request
     */

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return respondError(VALIDATION_ERROR, $validator->errors(), 422);
        }

        try {
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return respondSuccess(SUCCESS, $data, 201);
        } catch (Exception $e) {
            return respondError('Failed to create user' . $e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'You have been successfully logged out!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id): JsonResponse
    {
        $data = User::find($id);
        if ($data)
            return respondSuccess("Data retrieve successfully", $data);
        else
            return respondError('No data available', '', 404);
    }

    /**
     * Get the authenticated Current Loggined User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $data = Auth::user();
        if ($data)
            return respondSuccess("Data retrieve successfully", new UserResource($data));
        else
            return respondError('No data available', '', 404);
    }

    public function test()
    {
        return "Hello";
    }
}
