<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            "create meetups",
            "edit meetups",
            "delete meetups",
            "create organizations",
            "edit organizations",
            "delete organizations",
            "create organizationProfiles",
            "edit organizationProfiles",
            "delete organizationProfiles",
            "create speakers",
            "edit speakers",
            "delete speakers",
            "create news",
            "edit news",
            "delete news",
            "delete users",
        ];

        foreach ($permissions as $permission) {
            Permission::create(["name" => $permission]);
        }

        $role = Role::create(["name" => "admin"]);
        $role->givePermissionTo(Permission::all());
    }
}
