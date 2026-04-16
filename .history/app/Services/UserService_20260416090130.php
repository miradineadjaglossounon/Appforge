<?php

namespace App\Services;
use App\Models\User;
use App\Http\Requests\StoreUtilisateurRequest;

class UserService
{
    public function index()
    {
        $modules = $auth->user()
        ->modules()
        ->wherePivot('active',true)
        ->get();

    }

     public function activate($id)
    {
       return response()->json(['message' => 'Module activated']);

        
    }
}