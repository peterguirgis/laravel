<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthAPIcontroller extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            "message" => "welcome in system",
            "token" => $token,
            "user" => $user,
            "stauts" => "201",
        ];
        return response($response , 201);
    }


    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email",'=',$data['email'])->first();

        if (!Hash::check($data['password'], $user->password) && !$user) {
            $response = [
                "message" => "Try Agien",

            ];
        }

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            "message" => "welcome in system",
            "token" => $token,
            "user" => $user,
            "stauts" => "201",
        ];
        return response($response , 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        $response = [
            "message" => "logout success",
        ];
        return response($response , 201);
    }
}
