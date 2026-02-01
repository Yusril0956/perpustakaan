<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $anggota = Role::firstOrCreate(['name' => 'anggota']);

        $permissions = [
            'manage users',
            'manage books',
            'manage transactions',
            'view reports',
            'view books',
            'borrow books',
            'return books',
            'view own transactions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin->givePermissionTo(Permission::all());

        $staff->givePermissionTo([
            'manage books',
            'manage transactions',
            'view reports',
        ]);

        $anggota->givePermissionTo([
            'view books',
            'borrow books',
            'return books',
            'view own transactions',
        ]);
    }
}
