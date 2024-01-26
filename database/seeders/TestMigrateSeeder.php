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
            $param_user = [
                "id"            => $item['id'],
                'name'          => $item['name'],
                "email"         => $item['email'],
                "password"      => $item['password'],
                "gender"        => $item['gender'] == 'Male' ? 'male' : 'female',
                "address"       => $item['address'],
                "phone"         => $item['phone'],
                "status"        => $item['is_active'] == 1 ? 'active' : 'nonactive',
                "email_verified_at" => $item['email_verified_at'],
                "created_at"    => $item['created_at'],
                "updated_at"    => $item['updated_at'],
            ];
            User::create($param_user);
        }
        foreach ($server as $item) {
            $param_server = [
                "id"            => $item['id'],
                'name'          => $item['name'],
                "ip"            => $item['ip'],
                "domain"        => $item['domain'],
                "netwatch"      => $item['netwatch'],
                "location"      => $item['location'],
                "sufiks"        => $item['sufiks'],
                "port"          => $item['port'],
                "price"         => $item['price'],
                "annual_price"  => 100000,
                "last_ip"       => $item['last_ip'],
                "count_ip"      => $item['count_ip'],
                "last_port"     => $item['last_port'],
                'is_active'     => $item['is_active'] == 1 ? 'yes' : 'no',
                'is_available'  => 'yes',
                "created_at"    => $item['created_at'],
                "updated_at"    => $item['updated_at'],
            ];
            Server::create($param_server);
        }
        foreach ($vpn as $item) {
            $param_vpn = [
                "id"            => $item['id'],
                "user_id"       => $item['user_id'],
                "server_id"     => $item['server_id'],
                "ip"            => $item['ip'],
                "username"      => $item['username'],
                "password"      => $item['password'],
                "is_trial"      => $item['masa'] == 0 ? 'yes' : 'no',
                "expired"       => $item['expired'],
                "is_active"     => $item['is_active'] == 1 ? 'yes' : 'no',
                "created_at"    => $item['created_at'],
                "updated_at"    => $item['updated_at'],
            ];
            Vpn::create($param_vpn);
        }
        foreach ($port as $item) {
            $param_port = [
                "id"            => $item['id'],
                "vpn_id"        => $item['vpn_id'],
                "dst"           => $item['dst'],
                "to"            => $item['to'],
                "created_at"    => $item['created_at'],
                "updated_at"    => $item['updated_at'],
            ];

            Port::create($param_port);
        }

        // foreach ($router as $item) {
        //     $param_router
        //     Router::create($item);
        // }
    }
}
