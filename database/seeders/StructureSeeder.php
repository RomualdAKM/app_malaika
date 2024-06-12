<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Structure::factory()->create([
            'name' => 'Vibecro Corporation',
            'email' => 'contact@vibecro-corp.tech',
            'contact' => '55695656',
            'slug' => 'vibecro-corp.tech',
            'city' => 'Bohicon',
            'address' => 'Houndonho',
            'logo' => 'vibecro.png',
        ]);
    }
}
