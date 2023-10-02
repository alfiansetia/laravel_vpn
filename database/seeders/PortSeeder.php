<?php

namespace Database\Seeders;

use App\Models\Port;
use App\Models\Vpn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vpns = Vpn::all();

        for ($i = 0; $i < 3; $i++) {
            Port::factory()->create([
                'vpn_id' => 1,
            ]);
        }

        for ($i = 0; $i < 60; $i++) {
            Port::factory()->create([
                'vpn_id' => $vpns->random()->id,
            ]);
        }
    }
}
