<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        DB::table('categories')->insert([
            'name' => 'Thriller',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Romantika',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Detektívka',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Sci-Fi',
            'created_at' => Carbon::now(),
        ]);
    }
}
