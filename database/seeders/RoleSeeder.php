<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    // php artisan db:seed --class=RoleSeeder
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'escribano'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
