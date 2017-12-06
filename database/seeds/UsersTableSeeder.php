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
          'name' => 'Sample',
          'email' => 'laravel@sample.com',
          'password' => bcrypt('123456'),
          'is_admin' => true
        ]);
     }
}
