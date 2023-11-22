<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportFileUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(3);
        // dd($users);
        return view('screens.backend.users.list-user',['users' => $users]);
    }

    public function editUser(Request $request){
        // dd($user->roles);
        $user = User::find($request->id);
        $roles = $user->getRoleNames();
        $user->removeRole($roles);
        dd($user->roles);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->all();
        // dd($userRole[0]);
        return view('screens.backend.users.edit-user-permission',['user'=>$user,'roles'=>$roles, 'userRole'=>$userRole[0] ]);
    }
    
    public function showUser(){
        // $users = User::select('*')->paginate(10);
        return view('screens.backend.users.show-user');
    }


    public function exportUser($user){
        dd($user);
        return Excel::download(new ExportFileUser($user), 'users.xlsx');
    }
}
