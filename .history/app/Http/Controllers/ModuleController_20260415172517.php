<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return module::all();
    }

    public function activate($id)
{
    $module = Module::findOrFail($id);

    user_module::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'module_id' => $id
        ],
        ['active' => true]
    );

    return response()->json(['message' => 'Module activated']);
}
}
