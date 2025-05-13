<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/RolesSeeder.php

    public function run()
    {
        \App\Models\Role::create(['name' => 'admin']);
        \App\Models\Role::create(['name' => 'user']);
    }

}
