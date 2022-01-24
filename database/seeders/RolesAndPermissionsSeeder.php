<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'create users', 'read users', 'update users', 'delete users',
            'create categories', 'read categories', 'update categories', 'delete categories',
            'create subcategories', 'read subcategories', 'update subcategories', 'delete subcategories',
            'create brands', 'read brands', 'update brands', 'delete brands',
            'create discounts', 'read discounts', 'update discounts', 'delete discounts',
            'create products', 'read products', 'update products', 'delete products',
            'create orders', 'read orders', 'update orders', 'delete orders',
            'create coupons', 'read coupons', 'update coupons', 'delete coupons',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        // create roles and assign created permissions

        // or may be done by chaining
        Role::create(['name' => 'super-admin'])
        ->givePermissionTo(Permission::all());

        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all()->except(['create users','update users', 'delete users']));

        Role::create(['name' => 'employee'])
            ->givePermissionTo([
                'read users',
                'read categories',
                'read discounts',
                'create products', 'read products', 'update products', 'delete products',
            ]);
    }
}
