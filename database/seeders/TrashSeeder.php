<?php

namespace Database\Seeders;

use App\Models\Trash;
use Illuminate\Database\Seeder;

class TrashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image = 'image 1';

        Trash::insert([
            [
                "name" => 'plastique',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Métaux',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Verre',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Papier / Carton',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Textile',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Matière organique',
                'image' => $image,
                'points' => 10
            ],
            [
                'name' => 'Mégots',
                'image' => $image,
                'points' => 10
            ]
        ],);
    }
}
