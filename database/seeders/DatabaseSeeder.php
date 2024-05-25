<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * List of applications to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'product-list',
        'product-create',
        'product-edit',
        'product-delete',
        'order-list',
        'order-create',
        'order-edit',
        'order-delete',
        'contact-list',
        'contact-create',
        'contact-edit',
        'contact-delete',
        'categorie-list',
        'categorie-create',
        'categorie-edit',
        'categorie-delete'
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $sellerRole = Role::create(['name' => 'Seller']);
        $customerRole = Role::create(['name' => 'Customer']);

        // Sync permissions to roles (assuming Admin gets all permissions)
        $permissionsAdmin = Permission::pluck('id')->all();
        $adminRole->syncPermissions($permissionsAdmin);

        $sellerPermissions = [
            'product-list', 'product-create', 'product-edit', 'product-delete', 'categorie-list',
            'categorie-create',
            'categorie-edit',
            'categorie-delete'
        ];
        $sellerRole->givePermissionTo($sellerPermissions);

        $customerPermissions = [
            'product-list', 'order-list', 'order-create', 'order-edit', 'order-delete', 'contact-list', 'categorie-list',
            'categorie-create',
            'categorie-edit',
            'categorie-delete'
        ];
        $customerRole->givePermissionTo($customerPermissions);


        // Create users
        $adminUser = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $sellerUser = User::create([
            'name' => 'SellerAli',
            'email' => 'sellerali@example.com',
            'password' => Hash::make('password')
        ]);
        $customerAUser = User::create([
            'name' => 'CustomerA',
            'email' => 'costumer-a@example.com',
            'password' => Hash::make('password')
        ]);
        $customerBUser = User::create([
            'name' => 'CustomerB',
            'email' => 'costumer-b@example.com',
            'password' => Hash::make('password')
        ]);

        // Assign roles to users
        $adminUser->assignRole($adminRole);
        $sellerUser->assignRole($sellerRole);
        $customerAUser->assignRole($customerRole);
        $customerBUser->assignRole($customerRole);
    }
}
