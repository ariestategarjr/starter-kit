<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat peran (role) admin
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleUser = Role::create(['name' => 'user']);

        $user = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@starterkit.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleSuperAdmin->id
        ]);

        $user->assignRole($roleSuperAdmin);
    }
}
