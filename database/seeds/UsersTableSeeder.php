<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();

        /**
        * The makeVisible method temporarily displays the hidden attribute $hidden specified in the User model
        *
        * The insert method param must be of the type array
        */
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::first();
        $user->update([
          'name' => 'Kevin',
          'email' => '736074781@qq.com',
          'password' => bcrypt('111111'),
          'is_admin' => true
        ]);
     }
}
