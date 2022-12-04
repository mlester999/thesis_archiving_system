<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'thesisarchivingsystem@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('pnclibrary'),
            'acc_status' => '1',
            'role_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(PermissionSeeder::class);
    }
}
