<?php

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\Computer;
use App\Models\MaintenanceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $computer = Computer::inRandomOrder()->first();
        $clientName = $computer->client->user->name;
        $randomNumber = rand(100, 999);
        $timestamp = now()->format('Ymd');
        $maintenanceCode = $this->abbreviateName($clientName) . $randomNumber . $timestamp;

        // Generar una fecha de inicio única entre 2024 y 2026
        $startDate = fake()->unique()->dateTimeBetween('2024-01-01', '2025-05-31');
        // Generar una duración de mantenimiento entre 1 y 15 días
        $duration = rand(1, 15);
        $endDate = (clone $startDate)->modify("+$duration days");

        return [
            'code' => $maintenanceCode,
            'description' => fake()->sentence(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'observations' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'computer_id' => $computer->id, // Asignar a una computadora existente
            'maintenance_type_id' => MaintenanceType::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Abbreviate the client's name.
     */
    private function abbreviateName($name)
    {
        $words = explode(' ', $name);
        $abbreviation = '';

        foreach ($words as $word) {
            $abbreviation .= strtoupper($word[0]);
        }

        return $abbreviation;
    }
}
