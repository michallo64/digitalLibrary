<?php

use Faker\Provider\Barcode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = new \Faker\Generator();
        $barcode = new Barcode($faker);
        DB::table('books')->insert([
            'title' => "Hercule Poirot",
            'isbn' => $barcode->isbn10(),
            'price' => floatval("10.98"),
            'category_id' => 3,
            'author_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('books')->insert([
            'title' => "Sherlock Holmes",
            'isbn' => $barcode->isbn10(),
            'price' => floatval("15"),
            'category_id' => 3,
            'author_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('books')->insert([
            'title' => "TestBook",
            'isbn' => $barcode->isbn10(),
            'price' => floatval("8.80"),
            'category_id' => 1,
            'author_id' => 3,
            'created_at' => Carbon::now(),
        ]);
    }
}
