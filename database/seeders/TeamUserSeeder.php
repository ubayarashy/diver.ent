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
        // Kode untuk membuat user dummy baru dimasukkan di sini
        \App\Models\User::create([
            'name' => 'Alvonso Saragih',
            'email' => 'alvonsosaragih@gmail.com',
            'password' => bcrypt('alvonso'),
            'role' => 'team',
        ]);
    }
}