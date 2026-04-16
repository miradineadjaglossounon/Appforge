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
        $module = Module::findOrFail($id);

        UserModule::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'module_id' => $id
            ],
            ['active' => true]
        );

        return response()->json(['message' => 'Module activated']);
    }
}