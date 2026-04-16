<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'date_naissance'=>$data['date_naissance'],
            'phone'=>$data['phone'],
            'address' =>$data['address'],
            'password' => Hash::make($data['password']),

        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        return
            [
                'user' => $user,
                'token' => $token,
            ];

    }

     public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}


