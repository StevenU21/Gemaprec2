<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\Brand;
use App\Models\MaintenanceType;
use App\Models\PcModel;
use App\Models\PcType;
use App\Models\Ubication;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Client;
use App\Models\Computer;
use App\Models\Maintenance;
use App\Models\Activity;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolesAndPermissionsSeeder::class);
        User::factory(10)->employee()->create();
        Client::factory(30)->create();

        $adminRole = Role::where('name', 'admin')->first();
        $employeeRole = Role::where('name', 'employee')->first();
        $clientRole = Role::where('name', 'client')->first();

        $client = User::factory()->create([
            'name' => 'Client Test',
            'email' => 'client@gmail.com',
            'password' => bcrypt('client@gmail.com'),
        ]);

        $client->assignRole($clientRole);

        $employee = User::factory()->create([
            'name' => 'Employee Test',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('employee@gmail.com'),
        ]);

        $employee->assignRole($employeeRole);

        $admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com')
        ]);

        $admin->assignRole($adminRole);

        ActivityType::factory(6)->create();
        Brand::factory(20)->create();
        MaintenanceType::factory(4)->create();
        PcModel::factory(16)->create();
        PcType::factory(3)->create();
        Ubication::factory(4)->create();

        Computer::factory(50)->create();

        // Crear mantenimientos
        $maintenances = Maintenance::factory(50)->create();

        // Crear actividades para cada mantenimiento
        $maintenances->each(function ($maintenance) {
            $activityCount = rand(1, 4); // Número aleatorio de actividades por mantenimiento
            Activity::factory($activityCount)->create(['maintenance_id' => $maintenance->id]);
        });
    }
}
