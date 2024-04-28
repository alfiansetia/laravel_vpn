<?php

namespace Database\Seeders;

use App\Models\TemporaryIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChangeTemporarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temps = TemporaryIp::all();
        foreach ($temps as $item) {
            $item->update([
                'server_id' => 1
            ]);
        }
    }
}
