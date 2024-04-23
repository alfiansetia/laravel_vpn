<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::cleanDirectory(public_path('assets/img/logo'));
        Company::create([
            'name'          => 'KCNET',
            'phone'         => '082324129752',
            'slogan'        => 'Layanan VPN Remote Untuk Device Anda',
            'author'        => 'ALfian',
            'address'       => 'JL. Ngumbul - Todanan KM.01. Ngumbul Todanan Blora',
            'link_blog'     => 'https://blog.kacangan.net',
            'link_status'   => 'https://stats.uptimerobot.com/Xkn03tnOPl',
            'email'         => 'adm.kacangan@gmail.com',
        ]);
    }
}
