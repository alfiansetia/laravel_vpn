<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Port;
use App\Models\Router;
use App\Models\Server;
use App\Models\User;
use App\Models\Vpn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMigrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comp = json_decode(file_get_contents(public_path('files/json/comp.json')), true);
        $user = json_decode(file_get_contents(public_path('files/json/user.json')), true);
        $server = json_decode(file_get_contents(public_path('files/json/server.json')), true);
        $vpn = json_decode(file_get_contents(public_path('files/json/vpn.json')), true);
        $port = json_decode(file_get_contents(public_path('files/json/port.json')), true);
        $router = json_decode(file_get_contents(public_path('files/json/router.json')), true);
        // echo $comp;
        // foreach ($comp as $item) {
        //     Company::create($item);
        // }
        foreach ($user as $item) {
            $item->is_active = $item->is_active == 1 ? 'yes' : 'no';
            User::create($item);
        }
        foreach ($server as $item) {
            Server::create($item);
        }
        foreach ($vpn as $item) {
            Vpn::create($item);
        }
        foreach ($port as $item) {
            Port::create($item);
        }

        foreach ($router as $item) {
            Router::create($item);
        }
    }
}
