<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Alfi',
            'email'     => 'admin@gmail.com',
            'gender'    => 'Male',
            'address'   => 'Bks',
            'phone'     => '085222555885',
            'role'      => 'admin',
            'avatar'    => 'boy.png',
            'status'    => 'active',
            'password'  => Hash::make('admin12345'),
            'email_verified_at' => now(),
        ]);

        User::factory(50)->create();
    }
}
