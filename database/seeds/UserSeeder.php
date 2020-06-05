<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('123456');
        for ($i = 1; $i <= 3; $i++) {
            $user = new User();
            $user->full_name = "User {$i}";
            $user->email = "user{$i}@gmail.com";
            $user->password = $password;
            $user->type = User::TYPE_USER;
            $user->save();
        }
    }
}
