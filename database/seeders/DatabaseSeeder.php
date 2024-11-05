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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolesAndPermissionsSeeder::class);

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

        $employee2 = User::factory()->create([
            'name' => 'Employee2 Test',
            'email' => 'employee2@gmail.com',
            'password' => bcrypt('employee2@gmail.com'),
        ]);

        $employee->assignRole($employeeRole);
        $employee2->assignRole($employeeRole);

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
        Ubication::factory(20)->create();
    }
}
