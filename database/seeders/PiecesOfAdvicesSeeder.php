<?php

namespace Database\Seeders;

use App\Models\PiecesOfAdvices;
use Illuminate\Database\Seeder;

class PiecesOfAdvicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PiecesOfAdvices::factory()->count(100)->create();
    }
}
