<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Encuesta;
use App\Models\Pregunta;
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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret')
        ]);
        Encuesta::factory()->times(15)->create();
        Pregunta::factory()->times(8)->create()->each(function ($pregunta) {
            $pregunta->encuestas()->sync(
                Encuesta::all()->random(3)
            );
        });
    }
}
