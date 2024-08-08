<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'list-pelanggan',
            'create-pelanggan',
            'edit-pelanggan',
            'delete-pelanggan',
            'list-karyawan',
            'create-karyawan',
            'edit-karyawan',
            'delete-karyawan',
            'list-gaji',
            'create-gaji',
            'edit-gaji',
            'delete-gaji',
            'list-desain-product',
            'create-desain-product',
            'edit-desain-product',
            'delete-desain-product',
            'list-rencana-produksi',
            'create-rencana-produksi',
            'edit-rencana-produksi',
            'delete-rencana-produksi',
            'list-order',
            'create-order',
            'edit-order',
            'delete-order',
            'list-jadwal-produksi',
            'create-jadwal-produksi',
            'edit-jadwal-produksi',
            'delete-jadwal-produksi',
            'list-laporan-produksi',
            'create-laporan-produksi',
            'edit-laporan-produksi',
            'delete-laporan-produksi',
        ];


        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission]
            );
        }

        // GIVE ALL PERMISSON TO SUPERADMIN
        $superAdmin = Role::updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::all();
        $superAdmin->givePermissionTo($permissions);
    }
}
