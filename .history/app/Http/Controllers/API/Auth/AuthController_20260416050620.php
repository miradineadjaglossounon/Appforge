<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}


    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());
      

        return response()->json([
            'message' => 'Inscription réussie',
            'user' => $result['user'],
            'token' => $result['token']
        ], 201);
    }

    
    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json([
                'message' => 'Identifiants incorrects'
            ], 401);
        }
        return response()->json([
            'token' => $result['token'],
            'user_id' => $result[]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout réussi'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

   
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        return response()->json([
            'message' => 'Token généré',
            'token' => $token
        ]);
    }

  
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return response()->json([
                'message' => 'Token invalide'
            ], 400);
        }

        User::where('email', $record->email)->update([ 
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json([
            'message' => 'Mot de passe changé'
        ]);
    }
}