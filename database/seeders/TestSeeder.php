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
use Illuminate\Support\Facades\File;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json_path = public_path('files/json/');
        // if (!file_exists($json_path)) {
        //     File::makeDirectory(public_path('files/'));
        //     File::makeDirectory(public_path('json/'));
        //     // File::makeDirectory($json_path);
        // } else {
        //     File::cleanDirectory($json_path);
        // }
        $servers = Server::all();
        $vpns = Vpn::all();
        $users = User::all();
        $comp = Company::all();
        $ports = Port::all();
        $routers = Router::all();
        File::put($json_path . 'comp.json', $comp->toJson(JSON_PRETTY_PRINT));
        File::put($json_path . 'user.json', $users->toJson(JSON_PRETTY_PRINT));
        File::put($json_path . 'server.json', $servers->toJson(JSON_PRETTY_PRINT));
        File::put($json_path . 'vpn.json', $vpns->toJson(JSON_PRETTY_PRINT));
        File::put($json_path . 'port.json', $ports->toJson(JSON_PRETTY_PRINT));
        File::put($json_path . 'router.json', $routers->toJson(JSON_PRETTY_PRINT));
    }
}
