<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    
     //Liste des modules actifs
     
    public function index()
    {
        $modules = $this->userService->getActiveModules();

        return response()->json($modules);
    }

    /**
     * Activer un module
     */
    public function activate($id)
    {
        $this->userService->activateModule($id);

        return response()->json([
            'message' => 'Module activated'
        ]);
    }

    /**
     * Désactiver un module
     */
    public function deactivate($id)
    {
        $this->userService->deactivateModule($id);

        return response()->json([
            'message' => 'Module deactivated'
        ]);
    }
}