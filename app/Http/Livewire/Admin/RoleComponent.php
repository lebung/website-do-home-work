<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleComponent extends Component
{
    public $role , $userRole , $roleId, $okok=[];
    public $search = "";
    public $name, $permission = [];
    public $updateMode = false;
    public $rolePermissions;

    public function render()
    {   
        $roles = Role::where('name', 'LIKE', "%$this->search%")->paginate(10);
        $permissions = Permission::get();
        return view('livewire.backend.role.role-component',['roles'=>$roles, 'permissions'=>$permissions]);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->permission = [];
    }

    protected $rules = [
        'name' => 'required|min:6',
        'permission.*' => 'required',
    ];

    public function createRole(){
        $this->resetInput();
        $this->updateMode = false;
    }

    public function processRole(){
        $this->validate();
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permission);
        $this->resetInput();
    }

    public function editRole($id){
        $this->updateMode = true;
        $role = Role::find($id);
        $this->name = $role->name;
        $this->rolePermissions = $role->getAllPermissions()->pluck('id')->all();
        $this->permission = $this->rolePermissions;
        $this->roleId = $id;
        $this->dispatchBrowserEvent('contentChanged');
        // dd($this->rolePermissions);
        
    }

    public function saveEditRole(){
        $role = Role::find($this->roleId);
        // $role->name = $this->name;
        $role->update([
            'name' => $this->name,
        ]);
        $role->syncPermissions($this->permission);
        // dd($this->permission);

    }
}
