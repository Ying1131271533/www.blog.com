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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '神织知更',
            'email' => '1131271533@qq.com',
            'password' => Hash::make('Ying1131.'),
            'avatar' => 'avatars/SnHJEuiaUwFk69qvdIJvLFKJGpkNoxpQIu5DD6Ti.png',
        ]);
    }
}
