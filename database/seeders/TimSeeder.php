<?php

namespace Database\Seeders;

use App\Models\Tim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tim::factory()->count(50)->create();
    }
}
