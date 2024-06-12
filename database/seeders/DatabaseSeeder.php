<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            StructureSeeder::class
        ]);


        User::factory()->create([
            'structure_id' => 1,
            'name' => 'Super User',
            'email' => 'test@example.com',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
    }
}
