<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'created_by' => User::factory()->employee()->create()->id, // Creador con rol de empleado
            'user_id' => User::factory()->create()->assignRole('client')->id, // Usuario con rol de cliente
        ];
    }
}
