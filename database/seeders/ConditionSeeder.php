<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    // php artisan db:seed --class=ConditionSeeder

    public function run(): void
    {
        DB::table('conditions')->insert([
            ['name' => 'activo'],
            ['name' => 'jubilado'],
            ['name' => 'suspendido'],
            ['name' => 'licencia'],
            ['name' => 'inactivo'],
            ['name' => 'fallecido'],
        ]);
    }
}
