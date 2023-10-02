<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name'      => 'KCN',
            'phone'     => '082324129752',
            'address'   => 'Jl Bekasi',
            'logo'      => 'logo.png',
            'slogan'    => 'OK AJA',
        ]);
    }
}
