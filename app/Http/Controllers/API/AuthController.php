<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required',
            'password'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => $validator->errors()
            ]);
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'    => false,
                'message' => 'Incorrect email or password'
            ], 401);
        }
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'status'    => true,
                'message' => 'Hi ' . $user->email . ', welcome to dashboard',
                'data'  => [
                    'email' => $user->email
                ],
                'access_token' => $token,
            ]
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'status'  => true,
            'message' => 'Loged out successfully'
        ];
    }
}
