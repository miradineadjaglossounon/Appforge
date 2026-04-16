<?php

namespace App\Services;

use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Modules actifs de l'utilisateur connecté
     */
    public function getActiveModules()
    {
        return Auth::user()
            ->modules()
            ->wherePivot('active', true)
            ->get();
    }

    /**
     * Activer un module
     */
    public function activateModule($moduleId)
    {
        $module = Module::findOrFail($moduleId);

        return UserModule::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $moduleId
            ],
            ['active' => true]
        );
    }

    /**
     * Désactiver un module
     */
    public function deactivateModule($moduleId)
    {
        return UserModule::where('user_id', Auth::id())
            ->where('module_id', $moduleId)
            ->update(['active' => false]);
    }
}