<?php

namespace Database\Seeders;

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
        $selectDB = DB::table('categories');

        $selectDB->insert([
            'slug' => 'Food',
            'image' => 'food.jpg'
        ]);
        $selectDB->insert([
            'slug' => 'Social Life',
            'image' => 'social-life.jpg'
        ]);
        $selectDB->insert([
            'slug' => 'Transportation',
            'image' => 'transpotation.jpg'
        ]);
    }
}
