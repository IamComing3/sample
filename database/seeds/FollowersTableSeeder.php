<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // Get all user ID arrays that have removed ID to 1
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // Follow all users except the number 1 user
        $user->follow($follower_ids);

        // All users follow the 1 except the 1
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
