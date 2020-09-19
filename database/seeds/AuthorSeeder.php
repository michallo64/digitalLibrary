<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'name' => 'Arthur Connan Doyle',
            'created_at' => Carbon::now(),
        ]);
        DB::table('authors')->insert([
            'name' => 'Agatha Christie',
            'created_at' => Carbon::now(),
        ]);
        DB::table('authors')->insert([
            'name' => 'J. K. Rowling',
            'created_at' => Carbon::now(),
        ]);
    }
}
