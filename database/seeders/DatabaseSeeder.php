<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan db:seed
    public function run(): void
    {
        $this->seedInitialData();
        $this->call(UsersTableSeeder::class);

    }
    private function seedInitialData() {
        $this->call(RoleSeeder::class);
        $this->call(ConditionSeeder::class);
    }
}
