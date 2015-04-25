<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Notes\User;

class UsersSeeder extends Seeder
{

    public function run()
    {
        $user = new User;
        $user->username = "ruigomeseu";
        $user->avatar = "default.jpg";
        $user->name = "Rui Gomes";
        $user->token = 123;
        $user->save();
    }

}