<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registration(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $password = Hash::make($credentials['password']);

        $newUser = new User;
        $newUser->email = $credentials['email'];
        $newUser->password = $password;
        $newUser->name = 'user';
        $newUser->save();
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken($request->input('email'));
            return ['token' => $token->plainTextToken];
        }

        return response()->json([
            'message' => 'Validation failed',
            'errors' =>  'Предоставленные учетные данные не соответствуют нашим записям.'
        ], 422);

    }
}
