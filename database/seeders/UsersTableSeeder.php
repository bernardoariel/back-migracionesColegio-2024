<?php

namespace Database\Seeders;

use App\Models\Escribano;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => "Colegio",
                'lastname' => "Colegio",
                'email' => "colegiodeescribanosformosa@gmail.com",
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'register_number' => "0",
            ],
            [
                'name' => "MARIA EUGENIA",
                'lastname' => "COSENZA",
                'email' => "escribaniacosenza@gmail.com",
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'register_number' => "167",
            ],
            [
                'name' => "LIDIA YESICA",
                'lastname' => "HAMERNIK",
                'email' => "yesicahamernik@hotmail.com",
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'register_number' => "233",
            ]
            // Añade más usuarios si es necesario...
        ];

        foreach ($users as $userData) {
             // Guarda el register_number antes de crear el User y lo elimina del array
            $registerNumber = $userData['register_number'];
             unset($userData['register_number']); // Esto quitará 'register_number' del array $userData
 
             // Crea el usuario sin el campo 'register_number'
             $user = User::create($userData);

            // Luego, crea el escribano relacionado
            Escribano::create([
                'nombre' => $user->name,
                'apellido' => $user->lastname,
                'matricula' => $registerNumber,
                'user_id' => $user->id, // Esto establece la relación
                'dni' => rand(1000000, 99999999),
                'cuil' => 0,
                'sexo' => 'Otro',
                'direccion' => '',
                'telefono' => '',
                'email' => $user->email,
                'condicion_id' => 1
            ]);
        }

    }
}
