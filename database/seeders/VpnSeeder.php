<?php

namespace Database\Seeders;

use App\Models\Server;
use App\Models\User;
use App\Models\Vpn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VpnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $servers = Server::all();

        Vpn::factory()->create([
            'user_id'   => 1,
            'server_id' => 1,
        ]);

        for ($i = 0; $i < 20; $i++) {
            Vpn::factory()->create([
                'user_id'   => $users->random()->id,
                'server_id' => $servers->random()->id,
            ]);
        }
    }
}
