<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ]
        );
        Role::create(
            [
                'name' => 'manager',
                'guard_name' => 'web'
            ],
        );
        Role::create(
            [
                'name' => 'teacher',
                'guard_name' => 'web'
            ],
        );
        Role::create(
            [
                'name' => 'student',
                'guard_name' => 'web'
            ]
        );

        $users = [
            [
                'name' => fake()->name(),
                'email' => 'admin@example.com',
                'password' => '$2a$12$2nWXKpURCBvPkTcsG3IcF.ViZOHhsK4aJaAyM2lZsLuP55T9ndPTK',
                'avatar' => fake()->imageUrl(),
                'email_verified_at' => '2022-09-08 15:00:14',
                'status' => 1
            ],
            [
                'name' => fake()->name(),
                'email' => 'manager@example.com',
                'password' => '$2a$12$2nWXKpURCBvPkTcsG3IcF.ViZOHhsK4aJaAyM2lZsLuP55T9ndPTK',
                'avatar' => fake()->imageUrl(),
                'email_verified_at' => '2022-09-08 15:00:14',
                'status' => 1
            ],
            [
                'name' => fake()->name(),
                'email' => 'teacher@example.com',
                'password' => '$2a$12$2nWXKpURCBvPkTcsG3IcF.ViZOHhsK4aJaAyM2lZsLuP55T9ndPTK',
                'avatar' => fake()->imageUrl(),
                'email_verified_at' => '2022-09-08 15:00:14',
                'status' => 1
            ],
            [
                'name' => fake()->name(),
                'email' => 'student@example.com',
                'password' => '$2a$12$2nWXKpURCBvPkTcsG3IcF.ViZOHhsK4aJaAyM2lZsLuP55T9ndPTK',
                'avatar' => fake()->imageUrl(),
                'email_verified_at' => '2022-09-08 15:00:14',
                'status' => 1
            ],
        ];

        foreach ($users as $userItem) {
            $user = User::create($userItem);
            switch ($userItem['email']) {
                case 'admin@example.com':
                    $userSetRole = User::where('email', 'admin@example.com')->first();
                    $userSetRole->assignRole('admin');
                    break;
                case 'manager@example.com':
                    $userSetRole = User::where('email', 'manager@example.com')->first();
                    $userSetRole->assignRole('manager');
                    break;
                case 'teacher@example.com':
                    $userSetRole = User::where('email', 'teacher@example.com')->first();
                    $userSetRole->assignRole('teacher');
                    break;
                case 'student@example.com':
                    $userSetRole = User::where('email', 'student@example.com')->first();
                    $userSetRole->assignRole('student');
                    break;
            }
        }
    }
}
