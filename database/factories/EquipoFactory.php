<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    protected $model = Equipo::class;

    public function definition(): array
    {
        return [
            'codigo_patrimonial' => 'EQ-' . $this->faker->unique()->numerify('#####'),
            'marca' => $this->faker->randomElement(['Dell', 'HP', 'Lenovo', 'Asus', 'Apple']),
            'modelo' => $this->faker->word(),
            'cpu' => $this->faker->randomElement(['Intel i5', 'Intel i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
            'ram' => $this->faker->randomElement(['8GB', '16GB', '32GB']),
            'almacenamiento' => $this->faker->randomElement(['256GB SSD', '512GB SSD', '1TB HDD']),
            'estado' => $this->faker->randomElement(['Disponible', 'En Mantenimiento']), // no Asignado por defecto
            'categoria_id' => Categoria::factory(),
        ];
    }
}