<?php

namespace Database\Factories;

use App\Models\Computer;
use App\Models\Client;
use App\Models\Brand;
use App\Models\PcModel;
use App\Models\Ubication;
use App\Models\PcType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerFactory extends Factory
{
    protected $model = Computer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'serial_number' => fake()->unique()->numerify('SN-#####'),
            'mac_address' => fake()->macAddress(),
            'adquisition_date' => fake()->date(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'brand_id' => Brand::inRandomOrder()->first()->id, // Asignar a una marca existente
            'pc_model_id' => PcModel::inRandomOrder()->first()->id, // Asignar a un modelo de PC existente
            'ubications_id' => Ubication::inRandomOrder()->first()->id, // Asignar a una ubicación existente
            'pc_type_id' => PcType::inRandomOrder()->first()->id, // Asignar a un tipo de PC existente
            'client_id' => Client::inRandomOrder()->first()->id, // Asignar a un cliente existente
        ];
    }
}
