<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->profesor()->create([
            'name' => 'Profe',
            'email' => 'profe@biblioteca.com',
        ]);

        User::factory()->alumno()->create([
            'name' => 'Alumno',
            'email' => 'alumno@biblioteca.com',
        ]);

        User::factory()->alumno()->count(10)->create();
    }
}
