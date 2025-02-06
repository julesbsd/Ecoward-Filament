<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('challenge_types')->insert([
            [
                'name' => 'Ramassage',
                
            ],
            [
                'name' => 'passif',
                
            ],
            
        ]);
    }
}
