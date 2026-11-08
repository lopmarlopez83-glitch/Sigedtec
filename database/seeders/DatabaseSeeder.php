<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\Solicitud;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear roles
        $adminRole = Role::create(['nombre' => 'admin']);
        $solicitanteRole = Role::create(['nombre' => 'solicitante']);

        // 2. Crear usuarios
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Solicitante',
            'email' => 'solicitante@test.com',
            'password' => Hash::make('123456'),
            'role_id' => $solicitanteRole->id,
        ]);

        // 3. Crear categorías
        $categorias = Categoria::factory(5)->create();

        // 4. Crear 20 equipos distribuidos entre las categorías
        foreach ($categorias as $categoria) {
            Equipo::factory(4)->create(['categoria_id' => $categoria->id]);
        }

        // 5. Crear 10 solicitudes de ejemplo
        Solicitud::factory(10)->create([
            'user_id' => 2, // solicitante
        ]);
    }
}