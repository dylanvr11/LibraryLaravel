<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeed extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'number_id' => '1093221111',
            'name' => 'David',
            'last_name' => 'Torres',
            'email' => 'fernando.zapata.live@gmail.com',
            'password' => bcrypt(123456789),
        ]);
    }
}
