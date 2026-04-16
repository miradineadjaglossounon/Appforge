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
        $user = $userService
        return response()->json($modules);
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

    public function deactivate($id)
    {
        UserModule::where('user_id', auth()->id())
            ->where('module_id', $id)
            ->update(['active' => false]);

        return response()->json(['message' => 'Module deactivated']);
    }
}
