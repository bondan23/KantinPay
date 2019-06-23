<?php

use Szykra\Guard\Models\Permission;
use Szykra\Guard\Models\Role;
use Illuminate\Database\Seeder;

class GuardTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'ADMIN'  => 'Administrator',
            'USER' => 'User',
            'SELLER' => 'Seller'
        ];

        $permissions = [
            ['tag' => 'ACCESS.CREATE', 'name' => 'Create access', 'description' => 'Ability to create'],
            ['tag' => 'ACCESS.READ', 'name' => 'Read access', 'description' => 'Ability to read'],
            ['tag' => 'ACCESS.UPDATE', 'name' => 'Update access', 'description' => 'Ability to update'],
            ['tag' => 'ACCESS.DELETE', 'name' => 'Delete access', 'description' => 'Ability to delete'],
            ['tag' => 'TOPUP.CREATE', 'name' => 'Topup access', 'description' => 'Ability to topup'],
        ];

        $permModels = [];

        foreach ($permissions as $perm) {
            $permModels[$perm['tag']] = Permission::create($perm);
        }

        $rolesToPerm = [
            'ADMIN'  => ['ACCESS.CREATE', 'ACCESS.READ', 'ACCESS.UPDATE', 'ACCESS.DELETE', 'TOPUP.CREATE'],
            'USER' => ['ACCESS.CREATE', 'ACCESS.READ', 'ACCESS.UPDATE'],
            'SELLER' => ['ACCESS.CREATE', 'ACCESS.READ', 'ACCESS.UPDATE'],
        ];

        foreach ($rolesToPerm as $tag => $permissions) {
            $name = $roles[$tag];
            $role = Role::create(compact('tag', 'name'));

            foreach ($permissions as $perm) {
                $role->permissions()->save($permModels[$perm]);
            }
        }
    }
}