<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'classroom-list',
            'classroom-create',
            'classroom-edit',
            'classroom-delete',
            'question-list',
            'question-create',
            'question-edit',
            'question-delete',
            'quiz-list',
            'quiz-create',
            'quiz-edit',
            'quiz-delete',
         ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
