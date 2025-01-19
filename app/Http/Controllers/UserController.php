<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $params = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::create($params);
        $token = $user->createToken($request->name);
        return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
            return ['message' => 'The provided credentials are incorrect.'];
        $token = $user->createToken($user->name);
        return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return ['message' => 'You are logged out.'];
    }
}
