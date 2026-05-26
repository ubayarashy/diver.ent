<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hindari duplicate saat seeding ulang
        \App\Models\User::updateOrCreate(
            ['email' => 'alvonsositio@gmail.com'],
            [
                'name' => 'Alvonso Saragih',
                'password' => bcrypt('alvonso'),
                'role' => 'client',
            ]
        );

    }
}