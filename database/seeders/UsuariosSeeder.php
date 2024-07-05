<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'juan',
            'huella' => 'juan123',
            'email' => 'juan@example.com',
            'password' => Hash::make('password'), // Asegúrate de hashear las contraseñas
        ]);

        // Añade más usuarios si es necesario
        User::create([
            'name' => 'jorge',
            'huella' => 'jorge123',
            'email' => 'jorge@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
