<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define un array de permisos
        $permissions = [
            'create brands',
            'read brands',
            'update brands',
            'delete brands',
            'create pc_models',
            'read pc_models',
            'update pc_models',
            'delete pc_models',
            'create pc_types',
            'read pc_types',
            'update pc_types',
            'delete pc_types',
            'create ubications',
            'read ubications',
            'update ubications',
            'delete ubications',
            'create clients',
            'read clients',
            'update clients',
            'delete clients',
            'create activity_types',
            'read activity_types',
            'update activity_types',
            'delete activity_types',
            'create maintenance_types',
            'read maintenance_types',
            'update maintenance_types',
            'delete maintenance_types',
            'create maintenances',
            'read maintenances',
            'update maintenances',
            'delete maintenances',
            'create activities',
            'read activities',
            'update activities',
            'delete activities',
            'create notifications',
            'read notifications',
            'delete notifications',
            'read reports',
            'export reports',
            'read histories',
            'read calendars',
            'read computers',
            'create computers',
            'update computers',
            'delete computers',
        ];

        // Crea los permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crea los roles y les asigna los permisos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::firstOrCreate(['name' => 'employee']);
        $editorRole->givePermissionTo(
            [
                'read brands',
                'read pc_models',
                'read pc_types',
                'read ubications',
                'read clients',
                'create clients',
                'update clients',
                'read activity_types',
                'read maintenance_types',
                'read maintenances',
                'create maintenances',
                'update maintenances',
                'read activities',
                'create activities',
                'update activities',
                'delete activities',
                'read reports',
                'export reports',
                'read histories',
                'read calendars',
                'read computers',
                'create computers',
                'update computers',
                'delete computers',
                'read notifications',
                'delete notifications',
            ]
        );

        $viewerRole = Role::firstOrCreate(['name' => 'client']);
        $viewerRole->givePermissionTo([
            'read clients',
            'read reports',
            'read maintenances',
            'read activities',
            'read notifications',
            'read calendars',
            'delete notifications',
            'read computers',
        ]);
    }
}
