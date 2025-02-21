<?php

namespace Database\Seeders;

use App\Models\Action;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $description = "description de l'action";
        $location = "latitude: 48.8566, longitude: 2.3522";
        $format = 'Y-m-d H:i:s';

        Action::insert([
            [
                'action_type_id' => 1,
                // 'trash_id' => 1,
                'user_id' => 1,
                'challenge_id' => 1,
                'description' => $description,
                'image_action' => 'images/bouteille.jpg',
                'status' => 'pending',
                'location' => $location,
                'created_at' => Carbon::now()->format($format),
                'updated_at' => Carbon::now()->format($format),
            ],
            [
                'action_type_id' => 1,
                // 'trash_id' => 2,
                'user_id' => 11,
                'challenge_id' => 1,
                'description' => $description,
                'image_action' => 'image 1',
                'status' => 'accepted',
                'location' => $location,
                'created_at' => Carbon::now()->format($format),
                'updated_at' => Carbon::now()->format($format),
            ],
            [
                'action_type_id' => 1,
                // 'trash_id' => 3,
                'user_id' => 11,
                'status' => 'refused',
                'challenge_id' => 1,
                'description' => $description,
                'image_action' => 'image 1',
                'location' => $location,
                'created_at' => Carbon::now()->format($format),
                'updated_at' => Carbon::now()->format($format),
            ],
            
        ]);
    }
}
