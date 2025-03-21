<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Boismond',
                'email' => 'admin@ecoward.com',
                'email_verified_at' => now(),
                'company_id' => null,
                'role_id' => 2, // 'admin
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
            ],

        ],);
    }
}
