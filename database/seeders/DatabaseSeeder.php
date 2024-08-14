<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin126'), // Hash the password

        ]);

        $admin_role = Role::create(['name'=>'Admin']);
        $user_role = Role::create(['name'=>'User']);

        $user->assignRole($user_role);
        $admin->assignRole($admin_role);


    }
}
