<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Port;
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
        $db = json_decode(file_get_contents(public_path('files/json/db.json')), true);

        foreach ($db as $data) {
            if ($data['type'] == 'table' && $data['name'] == 'users') {
                foreach ($data['data'] as $item) {
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
                        "remember_token"    => $item['remember_token'],
                        "created_at"    => $item['created_at'],
                        "updated_at"    => $item['updated_at'],
                    ];
                    User::create($param_user);
                }
            }
        }

        foreach ($db as $data) {
            if ($data['type'] == 'table' && $data['name'] == 'servers') {
                foreach ($data['data'] as $item) {
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
                        "last_ip"       => $item['netwatch'],
                        'is_active'     => $item['is_active'] == 1 ? 'yes' : 'no',
                        'is_available'  => 'yes',
                        "created_at"    => $item['created_at'],
                        "updated_at"    => $item['updated_at'],
                    ];
                    Server::create($param_server);
                }
            }
        }

        foreach ($db as $data) {
            if ($data['type'] == 'table' && $data['name'] == 'vpns') {
                foreach ($data['data'] as $item) {
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
            }
        }

        foreach ($db as $data) {
            if ($data['type'] == 'table' && $data['name'] == 'ports') {
                foreach ($data['data'] as $item) {
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
            }
        }

        foreach ($db as $data) {
            if ($data['type'] == 'table' && $data['name'] == 'banks') {
                foreach ($data['data'] as $item) {
                    $param_bank = [
                        "id"            => $item['id'],
                        "name"          => $item['name'],
                        "acc_name"      => $item['acc_name'],
                        "acc_number"    => $item['acc_no'],
                        "is_active"     => $item['is_active'] == 'true' ? 'yes' : 'no',
                        "created_at"    => $item['created_at'],
                        "updated_at"    => $item['updated_at'],
                    ];
                    Bank::create($param_bank);
                }
            }
        }
    }
}
