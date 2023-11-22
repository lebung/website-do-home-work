<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        return view('screens.backend.permission.list-permission');
    }
    public function createPermission(){
        return view('screens.backend.permission.create-permission');
    }

    public function processPermission(Request $request){
        Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permission.list-permission')->with('status','Add permission successful');
    }
}
