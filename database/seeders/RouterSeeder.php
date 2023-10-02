<?php

namespace Database\Seeders;

use App\Models\Port;
use App\Models\Router;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Router::factory()->create([
            'user_id' => 1,
            'port_id' => 1,
        ]);
    }
}
