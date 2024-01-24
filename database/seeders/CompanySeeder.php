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
            'name'      => 'KCNET',
            'phone'     => '082324129752',
            'address'   => 'JL. Kampung Pasar Kembang, Yogyakarta',
            'slogan'    => 'Layanan VPN Remote Untuk Device Anda',
        ]);
    }
}
