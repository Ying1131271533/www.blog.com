<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorys')->insert([
            ['name' => 'HTML'],
            ['name' => 'JS'],
            ['name' => 'CSS'],
            ['name' => 'VUE'],
            ['name' => 'REACT'],
            ['name' => 'PHP'],
        ]);
    }
}
