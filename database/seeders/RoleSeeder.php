<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staff', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Customer', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
