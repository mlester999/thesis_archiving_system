<?php

namespace Database\Seeders;

use App\Models\Admin;
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

        
        $superAdmin = 'Super Admin';

        $superAdmin = Role::create(['name' => $superAdmin, 'guard_name' => 'admin', 'user' => 'super admin']);

        $users = [
            'Regular Students',
            'Graduating Students (Pending Thesis)',
            'Graduating Students (Approved Thesis)',
        ];

        foreach ($users as $user)   {
            $user = Role::create(['name' => $user, 'user' => 'student']);
        }

        $userPermissions = [
            'View Thesis',
            'Bookmark Thesis',
            'View Submission of Thesis',
            'Edit Submitted Thesis',
            'Submit Thesis',
        ];

        foreach ($userPermissions as $permission)   {
            Permission::create([
                'name' => $permission,
                'user' => 'student'
            ]);
        }

        $adminPermissions = [
            'Archive List',
            'Access List',
            'Student List',
            'College List',
            'Program List',
            'Research Agenda List',
            'Admin Users List',
            'Activity Logs',
            'Report Logs',
            'Download Logs',
            'Settings',
        ];

        foreach ($adminPermissions as $key => $permission)   {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin',
                'user' => 'admin'
            ]);

            $superAdminRole = Role::find(1);

            $superAdminRole->givePermissionTo($key + 6);

            $superAdminModel = Admin::find(1);

            $superAdminModel->assignRole($superAdmin);

        }
    }
}