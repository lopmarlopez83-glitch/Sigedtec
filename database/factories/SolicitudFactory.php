<?php

namespace Database\Factories;

use App\Models\Solicitud;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudFactory extends Factory
{
    protected $model = Solicitud::class;

    public function definition(): array
    {
        return [
            'oficina' => $this->faker->company(),
            'cantidad_equipos' => $this->faker->numberBetween(1, 5),
            'estado' => 'Pendiente',
            'user_id' => User::factory(),
            'categoria_id' => Categoria::factory(),
        ];
    }
}