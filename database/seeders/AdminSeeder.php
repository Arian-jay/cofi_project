<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'AEDRIAN PUSPUS',
            'email' => 'aedrian.puspus@carsu.edu.ph', // Use a unique email
            'phone' => '09300618270', // Optional
            'password' => Hash::make('123123123'), // Secure password
            'role_id' => 1, // Assign admin role
        ]);
        User::create([
            'name' => 'ARIAN JAY',
            'email' => 'priscoarianjay159@gmail.com', // Use a unique email
            'phone' => '09921331223', // Optional
            'password' => Hash::make('arianjay'), // Secure password
            'role_id' => 3, // Assign admin role
        ]);
        User::create([
            'name' => 'MAYI',
            'email' => 'kyleneangela.rocales@carsu.edu.ph', // Use a unique email
            'phone' => '09918823082', // Optional
            'password' => Hash::make('mayirocales'), // Secure password
            'role_id' => 1, // Assign admin role
        ]);
    }
}
