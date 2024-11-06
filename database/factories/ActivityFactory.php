<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Maintenance;
use App\Models\ActivityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maintenance = Maintenance::inRandomOrder()->first();
        $startDate = fake()->dateTimeBetween($maintenance->start_date, $maintenance->end_date);
        $duration = rand(1, 3);
        $endDate = (clone $startDate)->modify("+$duration days");

        // Asegurarse de que la fecha de finalización no exceda la fecha de finalización del mantenimiento
        if ($endDate > $maintenance->end_date) {
            $endDate = $maintenance->end_date;
        }

        return [
            'description' => fake()->sentence(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'maintenance_id' => $maintenance->id,
            'activity_type_id' => ActivityType::inRandomOrder()->first()->id, // Asignar a un ActivityType existente
        ];
    }
}
