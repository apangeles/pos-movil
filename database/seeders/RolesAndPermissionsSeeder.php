<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            'unidades',
            'afectacion_tipos',
            'clientes',
            'documentos_tipos',
            'productos',
            'ventas',
            'comprobante_tipos',
            'users',
            'roles_permisos',
        ];

        $actions = ['list', 'create', 'edit', 'delete'];

        $permissions = [];

        // Crear permisos con formato tabla_accion (ej. ventas_list)
        foreach ($tables as $table) {
            foreach ($actions as $action) {
                $permName = "{$table}_{$action}";
                $permissions[] = Permission::firstOrCreate(['name' => $permName]);
            }
        }


        // Crea Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $vendedorRole = Role::firstOrCreate(['name' => 'vendedor']);

        //Asignar los permisos al rol admin
        $adminRole->syncPermissions($permissions);

        // Permisos solo de ventas para vendedor
        $vendedorPerms = [
            'ventas_list',
            'ventas_create',
            'ventas_edit',
            'ventas_delete',
        ];
        $vendedorRole->syncPermissions($vendedorPerms);

        //Crear usuario Administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@prueba.com'],
            [
                'name' => 'Juan Carlos (Administrador)',
                'password' => Hash::make('admin'),
            ]
        );

        $adminUser->assignRole($adminRole);
    }
}
