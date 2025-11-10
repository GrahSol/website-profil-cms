<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections'
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        // Berikan semua permissions ke super admin
        $superAdminRole->syncPermissions($permissions);

        $user = User::create([
            'name' => 'FaizComp',
            'email' => 'super@admin.com', // Perbaikan typo: admim -> admin
            'password' => bcrypt('123123123')
        ]);
        
        $user->assignRole($superAdminRole);

        // Design Manager Role
        $designManagerRole = Role::firstOrCreate([
            'name' => 'design_manager' // Perbaikan: harus ada 'name' key
        ]);

        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonials',
        ];

        $designManagerRole->syncPermissions($designManagerPermissions);
    }
}