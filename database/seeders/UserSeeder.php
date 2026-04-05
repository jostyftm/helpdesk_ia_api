<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario de prueba con el rol admin
        User::factory()->count(1)->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ])->each(function ($user) {
            $user->assignRole('admin'); // Asigna el rol admin al usuario creado
        });

        // Crear usuarios de prueba con el rol cliente
        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('cliente'); // Asigna el rol cliente a los usuarios creados
        });

        // Crear usuarios de prueba con el rol agente
        User::factory()->count(5)->create()->each(function ($user) {
            $user->assignRole('agente'); // Asigna el rol agente a los usuarios creados
        });
    }
}
