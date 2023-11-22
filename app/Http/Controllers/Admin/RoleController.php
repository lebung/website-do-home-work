<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $permission = Permission::get();
        return view('screens.backend.role.list-role',['permissions'=>$permission]);
    }

    public function createRole(){
        $permission = Permission::get();
        return view('screens.backend.role.create-role',['permissions'=>$permission]);
    }

    public function processRole(Request $request){
        dd($request->all());
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);
        return back();
    }
}
