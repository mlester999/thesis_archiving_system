<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            'Graduating Student',
            'Regular Student',
        ];

        foreach ($users as $user)   {
            $user = Role::create(['name' => $user]);
        }

        $userPermissions = [
            'View Thesis',
            'Submit Thesis',
            'Submitted Thesis',
        ];

        foreach ($userPermissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}