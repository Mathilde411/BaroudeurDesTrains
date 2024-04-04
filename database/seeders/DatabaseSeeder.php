<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\GameState;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GameState::factory(3)
            ->sequence([
                ['name' => 'Lobby'],
                ['name' => 'En Jeu'],
                ['name' => 'Fini']
            ]);
    }
}
