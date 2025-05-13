<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Encuentra al usuario con id = 53
        $user = User::find(53); 

        // Encuentra el rol 'admin'
        $adminRole = Role::where('name', 'admin')->first(); 

        // Asigna el rol 'admin' al usuario
        $user->roles()->attach($adminRole); 
    }
}



