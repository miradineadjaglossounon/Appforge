<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModule;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $userService->index();

        return response()->json($user);
    }

        public function activate($id)
    {
     

        return response()->json(['message' => 'Module activated']);
    }

    public function deactivate($id)
    {
        UserModule::where('user_id', auth()->id())
            ->where('module_id', $id)
            ->update(['active' => false]);

        return response()->json(['message' => 'Module deactivated']);
    }
}
